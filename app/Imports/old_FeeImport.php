<?php namespace App\Imports;

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
            // Validate required fields
            if (collect($row)->filter()->isEmpty()) {
                return null; // Skip completely empty rows
            }
            if (!isset($row['batch_year'], $row['batch_name'], $row['section'])) {
                Log::error('Row skipped due to missing required fields: ' . json_encode($row));
                return null;
            }

            $batchName = trim((string) $row['batch_name']);
            $batch = batch::where('batch_name', $batchName)->first();

            if (!$batch) {
                Log::error("Batch not found: $batchName");
                return null;
            }


            // Find Book
            $book = Book::find($this->bookId);
            if (!$book) {
                Log::error('Book not found for ID: ' . $this->bookId);
                continue;
            }

            // Generate Document Number
            $docNumberData = Helper::generateDocumentNumberNew($book->id, Carbon::now()->toDateString());
            if (!$docNumberData) {
                Log::error('Failed to generate document number: ' . json_encode($row));
                continue;
            }

            // Parse Fee Details
            $feeDetailsArray = [];
            if (isset($row['fee_head'], $row['fee_amount'])) {
                $feeHeads = explode(",", (string) $row['fee_head']);
                $feeAmounts = explode(",", (string) $row['fee_amount']);
                $feeDiscounts = explode(",", (string) ($row['fee_discount'] ?? ''));
                $feeDiscountValues = explode(",", (string) ($row['fee_discount_value'] ?? ''));
                $netFees = explode(",", (string) ($row['net_fee'] ?? ''));
                $frequencies = explode(",", (string) ($row['frequency'] ?? ''));
                $mandatory = explode(",", (string) ($row['mandatory'] ?? ''));

                foreach ($feeHeads as $index => $feeHead) {
                    if (trim($feeHead) === '') {
                        continue; // Skip empty fee heads
                    }

                    $feeDetailsArray[] = [
                        'title' => trim($feeHead),
                        'total_fees' => $feeAmounts[$index] ?? null,
                        'fee_discount_percent' => $feeDiscounts[$index] ?? null,
                        'fee_discount_value' => $feeDiscountValues[$index] ?? null,
                        'net_fee_payable_value' => $netFees[$index] ?? null,
                        'payment_mode' => $frequencies[$index] ?? null,
                        'mandatory' => $mandatory[$index] ?? null,
                    ];
                }
            }

            // Create the Sport Fee Master Record
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
                'quota' => trim((string) ($row['quota'] ?? '')),
                'status' => 'active',
                'sport_name' => 'Badminton',
                'fee_details' => json_encode($feeDetailsArray),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

