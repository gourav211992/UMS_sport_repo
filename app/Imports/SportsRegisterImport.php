<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\Book;
use App\Models\SportRegister;
use App\Models\ums\sport_fee_master;
use App\Models\ums\Sport_master;
use App\Models\ums\SportBatch;
use App\Models\ums\SportFamilyDetail;
use App\Models\ums\SportQuota;
use App\Models\ums\SportGroupMaster;
use App\Models\ums\SportSection;
use App\Models\ums\User;
use Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SportsRegisterImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    protected $organization;
    protected $bookId;
    protected $errors = [];

    public function __construct($organization, $bookId)
    {
        $this->organization = $organization;
        $this->bookId = $bookId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $line = $index + 2; 

            try {
                if ($row->filter()->isEmpty()) {
                    continue;
                }

                $requiredFields = ['first_name', 'last_name', 'gender', 'date_of_birth', 'data_of_joining', 'mobile_number'];
                foreach ($requiredFields as $field) {
                    if (empty($row[$field])) {
                        $this->errors[] = "Row {$line}: Missing required field '{$field}'";
                        continue 2; 
                    }
                }

                $section_name = $row['section'];
                if (is_numeric($section_name)) {
                    $excelDate = Date::excelToDateTimeObject($section_name);
                    $section_name = strtoupper(Carbon::instance($excelDate)->format('M-y'));
                } elseif ($section_name instanceof \DateTimeInterface) {
                    $section_name = strtoupper(Carbon::instance($section_name)->format('M-y'));
                } else {
                    $section_name = trim((string)$section_name);
                }

                if (SportRegister::where('mobile_number', $row['mobile_number'])->where('email', $row['email_id'])->exists()) {
                    $this->errors[] = "Row {$line}: Duplicate entry for email '{$row['email_id']}'";
                    continue;
                }

                $book = Book::find($this->bookId);
                if (!$book) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Book not found (ID: {$this->bookId})";
                    continue;
                }

                $batch = SportBatch::where('batch_name', $row['batch'])->first();
                if (!$batch) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Batch '{$row['batch']}' not found";
                    continue;
                }

                $group = SportGroupMaster::where('name', $row['group'])->first();
                if (!$group) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Group '{$row['group']}' not found";
                    continue;
                }

                $section = SportSection::where('name', $section_name)->where('batch', $row['batch'])->first();
                if (!$section) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Section '{$section_name}' for batch '{$row['batch']}' not found";
                    continue;
                }

                $quota = SportQuota::where('quota_name', $row['quota'] ?? 'General')->first();
                if (!$quota) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Quota '{$row['quota']}' not found";
                }

                $sport = Sport_master::where('sport_name', $row['sport'] ?? 'Badminton')->first();
                if (!$sport) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Sport '{$row['sport']}' not found";
                }

                $docNumberData = Helper::generateDocumentNumberNew($book->id, Carbon::now()->toDateString());
                if (!$docNumberData) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Failed to generate document number";
                    continue;
                }

                $section_fee = sport_fee_master::all();
                $section_fee_id = $section_fee
                    ->where('section_id', $section->id)
                    ->firstWhere('quota', $row['quota'] ?? 'General');

                if (!$section_fee_id) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Fee not found for section '{$row['section']}' and quota '{$row['quota']}'";
                    continue;
                }

                $fee = $section_fee_id->fee_details ?? null;
                if (empty($fee)) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Fee details missing for section";
                    continue;
                }

                $batch_fee = sport_fee_master::where('batch_id', $batch->id)->first();
                $section_fees = sport_fee_master::where('section_id', $section->id)->first();

                if (!$batch_fee || !$section_fees) {
                    $this->errors[] = "Row {$line} {$row['email_id']}: Fee master entry missing for batch or section";
                    continue; 
                }

                $email = $row['email_id'];
                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                        'middle_name' => $row['middle_name'],
                        'user_name' => explode('@', $email)[0],
                        'mobile' => $row['mobile_number'],
                        'status' => 'active',
                        'password' => Hash::make('sport@123'),
                    ]
                );
                   $registrationNumber = $this->generateRegistrationNumber($row['level_of_play']??'');

                $sportRegister = SportRegister::create([
                    'organization_id' => $this->organization,
                    'doc_no' => $docNumberData['doc_no'],
                    'document_number' => $docNumberData['document_number'],
                    'document_date' => Carbon::now()->toDateString(),
                    'doc_reset_pattern' => $docNumberData['reset_pattern'],
                    'doc_prefix' => $docNumberData['prefix'],
                    'doc_suffix' => $docNumberData['suffix'],
                    'book_id' => $this->bookId,
                    'group_id' => 1,
                    'company_id' => 1,
                    'userable_id' => $user->id,
                    'name' => $row['first_name'],
                    'middle_name' => $row['middle_name'],
                    'last_name' => $row['last_name'],
                    'gender' => strtolower($row['gender']),
                    'dob' => $this->parseDate($row['date_of_birth']),
                    'doj' => $this->parseDate($row['data_of_joining']),
                    'mobile_number' => $row['mobile_number'],
                    'email' => $email,
                    'batch_id' => $batch->id,
                    'section_id' => $section->id,
                    'sport_id' => $sport?->id,
                    'quota_id' => $quota?->id,
                    'group' => $group->id,
                    'status' => 'approved',
                    'fee_details' => $fee,
                    'fee_batch_id' => $batch_fee->id,
                    'fee_section_id' => $section_fees->id,
                    'registration_number' => $registrationNumber,
                ]);
            //        $this->saveFamilyDetail($sportRegister->id, 'Father', $row['father_name'], 0);
            // $this->saveFamilyDetail($sportRegister->id, 'Local Guardian', $row['guardian_name'], 1);

                if (!empty($row['father_name'])) {
                    SportFamilyDetail::firstOrCreate([
                        'registration_id' => $sportRegister->id,
                        'relation' => 'Father',
                    ], [
                        'name' => $row['father_name'],
                        'is_guardian' => 0,
                    ]);
                }

                foreach (['guardian_name', 'guardian_name'] as $guardianField) {
                    if (!empty($row[$guardianField])) {
                        SportFamilyDetail::firstOrCreate([
                            'registration_id' => $sportRegister->id,
                            'relation' => 'Local Guardian',
                        ], [
                            'name' => $row[$guardianField],
                            'is_guardian' => 1,
                        ]);
                    }
                }

            } catch (\Throwable $e) {
                $this->errors[] = "Row {$line} {$row['email_id']}: Exception occurred - " . $e->getMessage();
                continue;
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function parseDate($value)
    {
        try {
            return is_numeric($value)
                ? Date::excelToDateTimeObject($value)
                : Carbon::parse($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    // private function saveFamilyDetail($registrationId, $relation, $name, $isGuardian)
    // {
    //     if (!$name) return;

    //     if (!SportFamilyDetail::where('registration_id', $registrationId)->where('relation', $relation)->exists()) {
    //         SportFamilyDetail::create([
    //             'registration_id' => $registrationId,
    //             'relation' => $relation,
    //             'name' => $name,
    //             'is_guardian' => $isGuardian,
    //         ]);
    //     }
    // }

     private function generateRegistrationNumber($level)
    {
        $levelCode = match (strtolower($level)) {
            'beginner' => 'BEG',
            'intermediate' => 'INT',
            'advanced' => 'ADV',
            default => 'UNK',
        };

        $last = SportRegister::where('registration_number', 'LIKE', 'SQ' . $levelCode . '%')
            ->orderBy('registration_number', 'desc')
            ->first();

        $newNumber = 25001;
        if ($last && preg_match('/(\d+)$/', $last->registration_number, $matches)) {
            $newNumber = (int)$matches[1] + 1;
        }

        return 'SQ' . $levelCode . $newNumber;
    }
}
