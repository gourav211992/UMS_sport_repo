<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\ums\sport_fee_master;
use App\Models\ums\SportBatch;
use App\Models\ums\SportSection;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Helpers\Helper;
use DateTime;

class FeeImport implements ToCollection, WithHeadingRow
{
    protected $bookId;
    protected $errors;

    public function __construct($bookId)
    {
        $this->bookId = $bookId;
        $this->errors = new MessageBag();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2; // Row number considering heading row is row 1

            if (collect($row)->filter()->isEmpty()) {
                continue;
            }

            if (!isset($row['batch_year'], $row['batch_name'], $row['section'])) {
                $this->errors->add("row_$rowNumber", "Missing required fields in row $rowNumber.");
                continue;
            }

            $batchName = trim((string) $row['batch_name']);
            $batchYear = trim((string) $row['batch_year']);
            $sectionName = trim((string) $row['section']);

            $batch = SportBatch::where('batch_name', $batchName)->where('batch_year', $batchYear)->first();
            $section = SportSection::where('name', $sectionName)->where('batch', $batchName)->first();

            if (!$batch) {
                $this->errors->add("row_$rowNumber", "Batch not found: $batchName  in row $rowNumber.");
                continue;
            }

            if (!$section) {
                $this->errors->add("row_$rowNumber", "Section not found: $sectionName in row $rowNumber.");
                continue;
            }

            $book = Book::find($this->bookId);
            if (!$book) {
                $this->errors->add("row_$rowNumber", "Book not found for book ID in row $rowNumber.");
                continue;
            }

            $docNumberData = Helper::generateDocumentNumberNew($book->id, Carbon::now()->toDateString());
            if (!$docNumberData) {
                $this->errors->add("row_$rowNumber", "Failed to generate document number in row $rowNumber.");
                continue;
            }

            if (empty($row['fee_head']) || empty($row['fee_amount'])) {
                $this->errors->add("row_$rowNumber", "Fee Head or Fee Amount missing in row $rowNumber.");
                continue;
            }

            // Clean and split
            $clean = fn($str) => preg_replace('/[^\w\s,-]/', '', preg_replace('/\s*[,]\s*/', ',', $str));
            $feeHeads = explode(",", $clean((string) $row['fee_head']));
            $feeAmounts = explode(",", $clean((string) $row['fee_amount']));
            $feeDiscounts = explode(",", $clean((string) ($row['fee_discount'] ?? '')));
            $feeDiscountValues = explode(",", $clean((string) ($row['fee_discount_value'] ?? '')));
            $frequencies = explode(",", $clean((string) ($row['frequency'] ?? '')));
            $mandatory = explode(",", $clean((string) ($row['mandatory'] ?? '')));

            $totals = $this->calculateFeeTotals($feeHeads, $feeAmounts, $feeDiscounts, $feeDiscountValues, $mandatory);

            $feeDetailsArray = [];
            foreach ($feeHeads as $i => $feeHead) {
                if (trim($feeHead) === '') continue;

                $amount = floatval($feeAmounts[$i] ?? 0);
                $discountValue = 0;

                if (!empty($feeDiscountValues[$i])) {
                    $discountValue = floatval($feeDiscountValues[$i]);
                } elseif (!empty($feeDiscounts[$i])) {
                    $discountPercent = floatval($feeDiscounts[$i]);
                    $discountValue = ($amount * $discountPercent) / 100;
                }

                $netFee = $amount - $discountValue;

                $feeDetailsArray[] = [
                    'title' => trim($feeHead),
                    'total_fees' => $amount,
                    'fee_discount_percent' => $feeDiscounts[$i] ?? null,
                    'fee_discount_value' => $discountValue,
                    'net_fee_payable_value' => $netFee,
                    'payment_mode' => $frequencies[$i] ?? null,
                    'mandatory' => $mandatory[$i] ?? null,
                    'grand_total_fees' => $totals['grand_total_fees'],
                    'grand_total_discount' => $totals['grand_total_discount'],
                    'grand_total_payable' => $totals['grand_total_payable'],
                    'duration' => ($frequencies[$i] ?? '') === 'Monthly' ? 6 : null,
                ];
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
                'batch_year' => $batchYear,
                'batch_id' => $batch->id,
                'batch' => $batchName,
                'section' => $sectionName,
                'section_id' => $section->id,
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

    private function calculateFeeTotals(array $feeHeads, array $feeAmounts, array $feeDiscountPercents, array $feeDiscountValues, array $mandatory): array
    {
        $totalFees = $totalDiscount = $totalPayable = 0;

        foreach ($feeHeads as $i => $head) {
            if (trim($head) === '') continue;
            if (strtolower(trim($mandatory[$i] ?? '')) !== 'yes') continue;

            $amount = floatval($feeAmounts[$i] ?? 0);
            $discount = floatval($feeDiscountValues[$i] ?? 0) ?: (floatval($feeDiscountPercents[$i] ?? 0) * $amount) / 100;

            $totalFees += $amount;
            $totalDiscount += $discount;
            $totalPayable += ($amount - $discount);
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

        $formats = ['Y-m-d', 'd-m-Y', 'd/m/Y', 'm/d/Y', 'd M Y', 'M d, Y'];

        foreach ($formats as $f) {
            $date = DateTime::createFromFormat($f, $value);
            if ($date && $date->format($f) === $value) {
                return $date->format($format);
            }
        }

        try {
            return date($format, strtotime($value));
        } catch (\Exception $e) {
            Log::error("Invalid date: {$value}");
            return null;
        }
    }
}
