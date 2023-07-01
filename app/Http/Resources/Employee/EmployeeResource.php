<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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

            'name'  => $this->name,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
            'permanent_address' => $this->permanent_address,
            'phone_number' => $this->phone_number,
            'gender'  => $this->gender,
            'marital_status' => $this->martial_status,
            'joined_date' => $this->joined_date,
            'termination_date' => $this->termination_date,
            'citizenship_number' => $this->citizenship_number,
            'profile_picture' => $this->profile_picture,
        ];
    }
}
