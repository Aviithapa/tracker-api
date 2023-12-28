<?php

namespace App\Services\LeaveType;

use App\Repositories\LeaveType\LeaveTypeRepository;

class LeaveTypeCreator
{
    protected $leaveTypeRepository;

    public function __construct(LeaveTypeRepository $leaveTypeRepository)
    {
        $this->leaveTypeRepository =  $leaveTypeRepository;
    }

    public function store($data)
    {
        $LeaveType = $this->leaveTypeRepository->create($data);
        return $LeaveType;
    }
}
