<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SportRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id'          => 'required|integer|exists:erp_books,id',
            'document_number'  => 'required|string|max:255',
            'document_date'    => 'required|date',
            'sport_id'         => 'required|integer|exists:sports_type,id',
            'name'             => 'required|string|max:255',
            'gender'           => 'required|in:male,female',
            'quota_id'         => 'required|integer|exists:quotas,id',
            'dob'              => 'required|date|before:today',
            'doj'              => 'required|date|after:dob',
        ];
    }
}
