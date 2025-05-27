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
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SportsRegisterImport implements ToCollection, WithHeadingRow, WithValidation,SkipsEmptyRows
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
            $rowNumber = $index + 2;
         
           
$section_name = $row['section'];

if (is_numeric($section_name)) {
    $excelDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($section_name);
    $section_name = strtoupper(Carbon::instance($excelDate)->format('M-y'));
} elseif ($section_name instanceof \DateTimeInterface) {
    $section_name = strtoupper(Carbon::instance($section_name)->format('M-y'));
} else {
    $section_name = trim((string) $section_name);
}

            

            if (SportRegister::where('mobile_number', $row['mobile_number'])->where('email', $row['email_id'])->exists()) {
                $this->errors[] = "Row $rowNumber: Duplicate SportRegister entry for mobile/email.";
                continue;
            }

            $book = Book::find($this->bookId);
            if (!$book) {
                $this->errors[] = "Row $rowNumber: Book not found for ID {$this->bookId}.";
                continue;
            }

            $batch = SportBatch::where('batch_name', $row['batch'])->first();
            if (!$batch) {
                $this->errors[] = "Row $rowNumber: Batch not found: {$row['batch']}.";
                continue;
            }

            $group = SportGroupMaster::where('name',$row['group'])->first();
 if (!$group) {
                $this->errors[] = "Row $rowNumber: Group not found: {$row['group']}.";
                continue;
            }
            $section = SportSection::where('name',  $section_name )->where('batch', $row['batch'])->first();
            if (!$section) {
           $this->errors[] = "Row $rowNumber: Section not found for batch: {$row['batch']} and section: " . $section_name . ".";
                continue;
            }

            $quota = SportQuota::where('quota_name', $row['quota'] ?? 'General')->first();
            if (!$quota) {
                $this->errors[] = "Row $rowNumber: Quota not found: {$row['quota']}.";
            }

            $sport = Sport_master::where('sport_name', $row['sport'] ?? 'Badminton')->first();
            if (!$sport) {
                $this->errors[] = "Row $rowNumber: Sport not found: {$row['sport']}.";
            }

            $docNumberData = Helper::generateDocumentNumberNew($book->id, Carbon::now()->toDateString());
            if (!$docNumberData) {
                $this->errors[] = "Row $rowNumber: Failed to generate document number.";
                continue;
            };

$batch_fee = sport_fee_master::all()->unique('batch');
$batch_fee_id = $batch_fee->firstWhere('batch_id', $batch->id);
   

$section_fee = sport_fee_master::all()->unique('section');
$section_fee_id = $section_fee->firstWhere('section_id',$section->id);



$batch_fee = sport_fee_master::all()->unique('batch');
$batch_fee_id = $batch_fee->firstWhere('batch_id', $batch->id);

$section_fee = sport_fee_master::all()->unique('section');
// dd($section_fee);    
$section_fee_id = $section_fee->firstWhere('section_id', $section->id);

if (!$batch_fee_id) {
    $this->errors[] = "Row $rowNumber: Batch fee not found for batch_id: {$batch->id}.";
    continue;
}

if (!$section_fee_id) {
    $this->errors[] = "Row $rowNumber: Section fee not found for section_id: {$section->id}.";
    continue;
}



        

            // Check or Create User
            $email = $row['email_id'];
            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = new User();
                $user->first_name = $row['first_name'];
                $user->last_name = $row['last_name'];
                $user->middle_name = $row['middle_name'];
                $user->user_name = explode('@', $email)[0];
                $user->mobile = $row['mobile_number'];
                $user->email = $email;
                $user->password = Hash::make('sport@123');

                if (!$user->save()) {
                    $this->errors[] = "Row $rowNumber: Failed to create user for email: $email.";
                    continue;
                }
            }

          

            // Save SportRegister
          $sportRegister=  SportRegister::create([
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
                'email' => $row['email_id'],
                'batch_id' => $batch->id,
                'section_id' => $section->id,
                'sport_id' => $sport ? $sport->id : null,
                'quota_id' => $quota ? $quota->id : null,
                'group' => $group->id,
                'fee_batch_id'=> $batch_fee_id->id,
                'fee_section_id'=>$section_fee_id->id
           
           
            ]);


            if (!empty($row['father_name'])) {
    $existingFather = SportFamilyDetail::where('registration_id', $sportRegister->id)
        ->where('relation', 'Father')
        ->first();

    if (!$existingFather) {
        $fatherDetail = new SportFamilyDetail();
        $fatherDetail->registration_id = $sportRegister->id;
        $fatherDetail->relation = 'Father';
        $fatherDetail->name = $row['father_name'];
        $fatherDetail->is_guardian = 0;

        if (!$fatherDetail->save()) {
            $this->errors[] = "Row $rowNumber: Failed to save family detail for Father: {$row['father_name']}.";
        }
    } else {
        $this->errors[] = "Row $rowNumber: Father already exists for this registration.";
    }
}

if (!empty($row['gurdian_name'])) {
    $existingGuardian = SportFamilyDetail::where('registration_id', $sportRegister->id)
        ->where('relation', 'Guardian')
        ->first();

    if (!$existingGuardian) {
        $guardianDetail = new SportFamilyDetail();
        $guardianDetail->registration_id = $sportRegister->id;
        $guardianDetail->relation = 'Local Guardian';
        $guardianDetail->name = $row['gurdian_name'];
        $guardianDetail->is_guardian = 1;

        if (!$guardianDetail->save()) {
            $this->errors[] = "Row $rowNumber: Failed to save family detail for Guardian: {$row['gurdian_name']}.";
        }
    } else {
        $this->errors[] = "Row $rowNumber: Guardian already exists for this registration.";
    }
}



if (!empty($row['guardian_name'])) {
    $guardianDetail = new SportFamilyDetail();
    $guardianDetail->registration_id = $sportRegister->id;
    $guardianDetail->relation = 'Local Guardian';
    $guardianDetail->name = $row['guardian_name'];
    $guardianDetail->is_guardian = 1;

    if (!$guardianDetail->save()) {
        $this->errors[] = "Row $rowNumber: Failed to save family detail for Guardian: {$row['guardian_name']}.";
    }
}


        }

    }

    public function rules(): array
    {
        return [
            '*.first_name' => ['required', 'string', 'max:50'],
            '*.last_name' => ['required', 'string', 'max:50'],
            '*.gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            '*.date_of_birth' => ['required'],
            '*.data_of_joining' => ['required'],
            '*.mobile_number' => ['required', 'digits:10'],
            '*.email_id' => ['nullable', 'email'],
        ];
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
}
