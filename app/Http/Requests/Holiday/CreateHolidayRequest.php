<?php

namespace App\Http\Requests\Holiday;

use Illuminate\Foundation\Http\FormRequest;

class CreateHolidayRequest extends FormRequest
{

    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255', 'date'],
        ];
    }
}
