<?php

namespace App\Http\Resources\Leave;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
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
            'reason'  => $this->reason,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'employee' => $this->employee,
            'reject_reason' => $this->reject_reason,
            'status' => $this->status,
            'leaveType' => $this->leaveType,
            'no_of_days' => $this->no_of_days,
            'status' => $this->status,
        ];
    }
}
