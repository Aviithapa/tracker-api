<?php

namespace App\Services\Attendance;

use App\Models\Attendance;
use App\Models\Employee;
use App\Repositories\Area\AreaRepository;
use App\Repositories\Attendance\AttendanceRepository;
use App\Repositories\AttendanceDetailData\AttendanceDetailDataRepository;
use App\Repositories\Employee\EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AddNewAttendanceByAdmin
 * @package App\Services\AddNewAttendanceByAdmin
 */
class AddNewAttendanceByAdmin
{

    /**
     * @var AttedanceRepository, @var EmployeeRepository, @var AttendanceDetailDataRepository
     */
    protected $attendanceRepository, $employeeRepository, $attendanceDetailDataRepository;

    /**
     * CheckInCheckOutService constructor.
     * @param AttendanceRepository $attendanceRepository
     */
    public function __construct(AttendanceRepository $attendanceRepository, EmployeeRepository $employeeRepository, AttendanceDetailDataRepository $attendanceDetailDataRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->employeeRepository = $employeeRepository;
        $this->attendanceDetailDataRepository = $attendanceDetailDataRepository;
    }


    public function addAttendanceByAdmin($attendance)
    {
        $employee = $this->employeeRepository->findById($attendance['employeeId']);
        if (!$employee) {
            throw new  NotFoundHttpException('Employee not found');
        }
        $working_from = 'HOME';
        $logs = collect($attendance['attendanceLogs'])
            ->filter(function ($value) {
                return Carbon::parse($value['check_in'])->lt(Carbon::parse($value['check_out']));
            })
            ->map(function ($value) use ($attendance, $working_from, $employee) {
                return [
                    'employee_id' => $employee['id'], // Replace with your actual employee variable
                    'working_from' => $working_from,
                    'in_comment' => 'Added By Admin',
                    'out_comment' => 'Updated By Admin',
                    'check_in' => Carbon::create(
                        Carbon::parse($attendance['attendanceDate'])->year,
                        Carbon::parse($attendance['attendanceDate'])->month,
                        Carbon::parse($attendance['attendanceDate'])->day,
                        Carbon::parse($value['check_in'])->hour,
                        Carbon::parse($value['check_in'])->minute
                    ),
                    'check_out' => Carbon::create(
                        Carbon::parse($attendance['attendanceDate'])->year,
                        Carbon::parse($attendance['attendanceDate'])->month,
                        Carbon::parse($attendance['attendanceDate'])->day,
                        Carbon::parse($value['check_out'])->hour,
                        Carbon::parse($value['check_out'])->minute
                    ),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            });


        $attendanceStore = DB::table('attendance')->insert($logs->toArray());
        return $attendanceStore;
    }


    public function deleteEmployeeAttendanceForDate($data)
    {
        $employeeId = $data['employeeId'];
        $date = Carbon::parse($data['attendanceDate']);

        // Truncate the date to only include the date part (remove time)
        $date->startOfDay();

        $attendanceRecords = Attendance::whereDate('check_in', $date)
            ->where('employee_id', $employeeId)
            ->get();

        // Soft delete the records
        $attendanceRecords->each(function ($record) {
            $record->delete();
        });

        return $this->addAttendanceByAdmin($data);
    }
}
