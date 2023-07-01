<?php

namespace App\Services\AttendanceDetailData;


use App\Repositories\AttendanceDetailData\AttendanceDetailDataRepository;


/**
 * Class CheckInCheckOutService
 * @package App\Services\Attendance
 */
class AttendanceDetailDataCreator
{
    /**
     * @var AttendanceDetailDataRepository
     */
    protected $attendanceDetailDataRepository, $employeeRepository;

    /**
     * CheckInCheckOutService constructor.
     * @param AttendanceDetailDataRepository $attendanceDetailDataRepository
     */
    public function __construct(AttendanceDetailDataRepository $attendanceDetailDataRepository)
    {
        $this->attendanceDetailDataRepository = $attendanceDetailDataRepository;
    }


    public function store($data)
    {
        return $this->attendanceDetailDataRepository->create($data);
    }
}
