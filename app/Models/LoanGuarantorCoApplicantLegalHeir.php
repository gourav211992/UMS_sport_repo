<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanGuarantorCoApplicantLegalHeir extends Model
{
    protected $table = 'erp_loan_guarantor_co_applicant_legal_heirs';

    use HasFactory;
    protected $guarded = ['id'];

    public function loanGuarantorCoApplicant()
    {
        return $this->belongsTo(LoanGuarantorCoApplicant::class, 'loan_guarantor_co_applicant_id');
    }
}
