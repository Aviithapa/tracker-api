<?php

namespace App\Http\Requests\FiscalYear;

use Illuminate\Foundation\Http\FormRequest;

class CreateFiscalYearRequest extends FormRequest
{

    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            "start_date_en"    => ['required'],
            "start_date_np"  => ['required'],
            "end_date_en" => ['required'],
            "end_date_np" => ['required'],
            "status" => ['required'],
        ];
    }
}
