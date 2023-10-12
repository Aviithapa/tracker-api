<?php

namespace App\Http\Resources\FiscalYear;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FiscalYearResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name'  => $this->name,
            'start_year_nepali' => $this->start_year_nepali,
            'end_year_nepali' => $this->end_year_nepali,
            'start_year_english' => $this->start_year_english,
            'end_year_english' => $this->end_year_english,
            'status' => $this->status,
        ];
    }
}
