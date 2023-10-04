<?php

namespace App\Services\Leave;

use App\Models\Leave;
use App\Repositories\Leave\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class LeaveGetter
 * @package App\Services\Leave
 */
class LeaveGetter
{
    /**
     * @var leaveRepository
     */
    protected $leaveRepository;

    /**
     * LeaveGetter constructor.
     * @param LeaveRepository $leaveRepository
     */
    public function __construct(LeaveRepository $leaveRepository)
    {
        $this->leaveRepository = $leaveRepository;
    }

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList($request): LengthAwarePaginator
    {
        return $this->leaveRepository->getPaginatedList($request);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->leaveRepository->findById($id);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function getLeaveByEmployeeId($id)
    {
        return $this->leaveRepository->getAll()->where('employee_id', $id);
    }


    public function checkOverlappingLeaves($employeeId, $endDate, $startDate)
    {
        $overlappingLeaves = Leave::where('employee_id', $employeeId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $startDate);
                })->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '>=', $startDate)
                        ->where('start_date', '<=', $endDate);
                });
            })
            ->get();
        return $overlappingLeaves;
    }
}
