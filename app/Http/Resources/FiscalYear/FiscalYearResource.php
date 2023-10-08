<?php

namespace App\Http\Resources\FiscalYear;

use Illuminate\Http\Resources\Json\JsonResource;

class FiscalYearResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "start_date_en" => $this->start_date_en,
            "start_date_np" => $this->start_date_np,
            "end_date_en" => $this->end_date_en,
            "end_date_np" => $this->end_date_np,
            "status" => $this->status
        ];
    }
}
