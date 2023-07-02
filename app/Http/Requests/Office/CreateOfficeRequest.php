<?php

namespace App\Http\Requests\Office;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfficeRequest extends FormRequest
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
            'file' => ['required', 'file'],
        ];
    }
}
