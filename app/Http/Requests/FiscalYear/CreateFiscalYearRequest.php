<?php

namespace App\Http\Requests\FiscalYear;

use Illuminate\Foundation\Http\FormRequest;

class CreateFiscalYearRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'start_year_english' => ['required', 'string', 'max:255'],
            'end_year_english' => ['required', 'string', 'max:255'],
            'start_year_nepali' => ['required', 'string', 'max:255'],
            'end_year_nepali' => ['required', 'string', 'max:255'],

        ];
    }
}
