<?php

namespace App\Services\LeaveType;

use App\Repositories\LeaveType\LeaveTypeRepository;

/**
 * Class LeaveTypeUpdater
 * @package App\Services\Apartment
 */
class LeaveTypeUpdater
{
    /**
     * @var LeaveTypeRepository
     */
    protected $leaveTypeRepository;

    /**
     * LeaveTypeCreator constructor.
     * @param LeaveTypeRepository $leaveTypeRepository
     */
    public function __construct(LeaveTypeRepository $leaveTypeRepository)
    {
        $this->leaveTypeRepository = $leaveTypeRepository;
    }

    public function update($data, $id)
    {
        $LeaveType =  $this->leaveTypeRepository->findById($id);

        if ($LeaveType) {
            $LeaveTypeUpdate = $this->leaveTypeRepository->update($data, $LeaveType->id);
            if ($LeaveTypeUpdate === false) {
                return response()->json(['error' => 'Internal Error'], 500);
            }
            return $LeaveType;
        }
        return response()->json(['error' => 'Not Found'], 404);
    }
}
