<?php

namespace App\Services\LeaveType;

use App\Models\LeaveType;
use App\Repositories\LeaveType\LeaveTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class LeaveTypeGetter
 * @package App\Services\LeaveType
 */
class LeaveTypeGetter
{
    /**
     * @var LeaveTypeRepository
     */
    protected $leaveTypeRepository;

    /**
     * LeaveTypeGetter constructor.
     * @param LeaveTypeRepository $leaveTypeRepository
     */
    public function __construct(LeaveTypeRepository $leaveTypeRepository)
    {
        $this->leaveTypeRepository = $leaveTypeRepository;
    }

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList($request): LengthAwarePaginator
    {
        return $this->leaveTypeRepository->getPaginatedList($request);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->leaveTypeRepository->findById($id);
    }
}
