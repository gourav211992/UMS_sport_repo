<?php

namespace App\Imports;

use App\Http\Controllers\BookController;
use App\Models\ums\batch;
use App\Models\ums\sport_fee_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use App\Models\Book;
use App\Helpers\Helper;
use App\Models\ums\Section;
use DateTime;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;

class FeeImport implements ToCollection, WithHeadingRow
{
    protected $bookId;

    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (collect($row)->filter()->isEmpty()) return null;

            if (!isset($row['batch_year'], $row['batch_name'], $row['section'])) {
                Log::error('Row skipped due to missing required fields: ' . json_encode($row));
                return null;
            }

            $batchName = trim((string) $row['batch_name']);
            $batchYear = trim((string) $row['batch_year']);
            $section=  trim((string) $row['section']);


            $batch = batch::where('batch_name', $batchName)->where('batch_year',$batchYear)->first();
            $section= Section::where('name',$section)->where('batch',$batchName)->first();


            if (!$batch) {
                Log::error("Batch not found: $batchName");
                return null;
            }

            $book = Book::find($this->bookId);
            if (!$book) {
                Log::error('Book not found for ID: ' . $this->bookId);
                continue;
            }

            $docNumberData = Helper::generateDocumentNumberNew($book->id, Carbon::now()->toDateString());
            if (!$docNumberData) {
                Log::error('Failed to generate document number: ' . json_encode($row));
                continue;
            }

            $feeDetailsArray = [];

            if (isset($row['fee_head'], $row['fee_amount'])) {
                $clean = function ($str) {
                    
                    $str = preg_replace('/\s*[,]\s*/', ',', $str);
                
                  
                    $str = preg_replace('/[^\w\s,-]/', '', $str);
                
                    return $str;
                };

                $feeHeads = explode(",", $clean((string) $row['fee_head']));
                $feeAmounts = explode(",", $clean((string) $row['fee_amount']));
                $feeDiscounts = explode(",", $clean((string) ($row['fee_discount'] ?? '')));
                $feeDiscountValues = explode(",", $clean((string) ($row['fee_discount_value'] ?? '')));
                $frequencies = explode(",", $clean((string) ($row['frequency'] ?? '')));
                $mandatory = explode(",", $clean((string) ($row['mandatory'] ?? '')));

               
                $totals = $this->calculateFeeTotals($feeHeads, $feeAmounts, $feeDiscounts, $feeDiscountValues, $mandatory);

                foreach ($feeHeads as $index => $feeHead) {
                    if (trim($feeHead) === '') continue;

                    $amount = floatval($feeAmounts[$index] ?? 0);
                    $discountValue = 0;

                    if (!empty($feeDiscountValues[$index])) {
                        $discountValue = floatval($feeDiscountValues[$index]);
                    } elseif (!empty($feeDiscounts[$index])) {
                        $discountPercent = floatval($feeDiscounts[$index]);
                        $discountValue = ($amount * $discountPercent) / 100;
                    }

                    $netFee = $amount - $discountValue;

                    // $feeDetailsArray[] = [
                    //     'title' => trim($feeHead),
                    //     'total_fees' => $amount,
                    //     'fee_discount_percent' => $feeDiscounts[$index] ?? null,
                    //     'fee_discount_value' => $discountValue,
                    //     'net_fee_payable_value' => $netFee,
                    //     'payment_mode' => $frequencies[$index] ?? null,
                    //     'mandatory' => $mandatory[$index] ?? null,
                    //     'grand_total_fees' => $totals['grand_total_fees'],
                    //     'grand_total_discount' => $totals['grand_total_discount'],
                    //     'grand_total_payable' => $totals['grand_total_payable'],
                    // ];
                    $feeDetailsArray[] = [
                        'title' => trim($feeHead),
                        'total_fees' => $amount,
                        'fee_discount_percent' => $feeDiscounts[$index] ?? null,
                        'fee_discount_value' => $discountValue,
                        'net_fee_payable_value' => $netFee,
                        'payment_mode' => $frequencies[$index] ?? null,
                        'mandatory' => $mandatory[$index] ?? null,
                        'grand_total_fees' => $totals['grand_total_fees'],
                        'grand_total_discount' => $totals['grand_total_discount'],
                        'grand_total_payable' => $totals['grand_total_payable'],
                        'duration' => ($frequencies[$index] === 'Monthly') ? 6 : null,
                    ];
                    
                }
            }

            sport_fee_master::create([
                'series' => null,
                'organization_id' => 8,
                'doc_no' => $docNumberData['doc_no'],
                'document_number' => $docNumberData['document_number'],
                'document_date' => Carbon::now()->toDateString(),
                'doc_reset_pattern' => $docNumberData['reset_pattern'],
                'doc_prefix' => $docNumberData['prefix'],
                'doc_suffix' => $docNumberData['suffix'],
                'group_id' => 1,
                'company_id' => 1,
                'book_id' => $this->bookId,
                'batch_year' => trim((string) $row['batch_year']),
                'batch_id' => $batch->id,
                'batch' => trim((string) $row['batch_name']),
                'section' => trim((string) $row['section']),
                'section_id'=>$section->id,
                'quota' => trim((string) ($row['quota'] ?? '')),
                'start_date' => $this->excelToDateSmart($row['from_date']),
                'end_date' => $this->excelToDateSmart($row['to_date']),
                'status' => 'Active',
                'sport_name' => 'Badminton',
                'fee_details' => json_encode($feeDetailsArray),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }



    
        private function calculateFeeTotals(
        array $feeHeads,
        array $feeAmounts,
        array $feeDiscountPercents,
        array $feeDiscountValues,
        array $mandatory
    ): array {
        $totalFees = 0;
        $totalDiscount = 0;
        $totalPayable = 0;
    
        foreach ($feeHeads as $index => $head) {
            if (trim($head) === '') continue;
    
            $isMandatory = strtolower(trim($mandatory[$index] ?? '')) === 'yes';
            if (!$isMandatory) continue;
    
            $amount = floatval($feeAmounts[$index] ?? 0);
    
            $discountValue = floatval($feeDiscountValues[$index] ?? 0);
            $discountPercent = floatval($feeDiscountPercents[$index] ?? 0);
    
            $finalDiscount = 0;
    
            if ($discountValue > 0) {
               
                $finalDiscount = $discountValue;
            } elseif ($discountPercent > 0) {
               
                $finalDiscount = ($amount * $discountPercent) / 100;
            }
    
            $netFee = $amount - $finalDiscount;
    
            $totalFees += $amount;
            $totalDiscount += $finalDiscount;
            $totalPayable += $netFee;
        }
    
        return [
            'grand_total_fees' => round($totalFees, 2),
            'grand_total_discount' => round($totalDiscount, 2),
            'grand_total_payable' => round($totalPayable, 2),
        ];
    }
    

    private function excelToDateSmart($value, $format = 'Y-m-d')
    {
        $value = trim((string) $value);

        if (is_numeric($value)) {
            return date($format, strtotime("1899-12-30 +$value days"));
        }

        $possibleFormats = [
            'Y-m-d', 'd-m-Y', 'm-d-Y', 'd/m/Y', 'm/d/Y', 'd.m.Y', 'm.d.Y',
            'Y/m/d', 'Y.m.d', 'd M Y', 'M d, Y'
        ];

        foreach ($possibleFormats as $f) {
            $date = DateTime::createFromFormat($f, $value);
            if ($date && $date->format($f) === $value) {
                return $date->format($format);
            }
        }

        try {
            return date($format, strtotime($value));
        } catch (\Exception $e) {
            Log::error("Invalid date format: {$value}");
            return null;
        }
    }
}
