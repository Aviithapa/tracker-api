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

/**
 * Class CheckInCheckOutService
 * @package App\Services\Attendance
 */
class CheckInCheckOutService
{
    /**
     * @var AreaRepository
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


    public function evaluateCheckInCheckOut($data)
    {
        $user = Auth::user();
        $employee = $this->employeeRepository->findById($user['employee_id']);
        if (!$employee) {
            return response()->json(['error' => 'Employee not Found'], 404);
        }

        $coordinates = DB::table('area')->select('latitude', 'longitude')->where('office_id', $employee['office_id'])->get();

        $polygonCoordinates = $coordinates->map(function ($coordinate) {
            return [$coordinate->latitude, $coordinate->longitude];
        })->toArray();

        $latitude = $data['latitude']; // Example latitude
        $longitude = $data['longitude']; // Example longitude

        $point = [$latitude, $longitude];
        $isInside = $this->point_in_polygon($point, $polygonCoordinates);

        $data['employee_id'] = $employee->id;
        if ($isInside) {
            return $this->checkIn($data);
        } else {
            return $this->checkOut($data);
        }
    }

    function point_in_polygon($point, $polygonCoordinates)
    {
        $n = count($polygonCoordinates);
        $inside = false;
        $p1 = $polygonCoordinates[0];
        for ($i = 1; $i < $n; $i++) {
            $p2 = $polygonCoordinates[$i];
            if ($point[1] > min($p1[1], $p2[1]) && $point[1] < max($p1[1], $p2[1])) {
                if ($point[0] < ($p2[0] - $p1[0]) * ($point[1] - $p1[1]) / ($p2[1] - $p1[1]) + $p1[0]) {
                    $inside = !$inside;
                }
            }
            $p1 = $p2;
        }
        return $inside;
    }



    private function checkIn($data)
    {
        $today = Carbon::today()->toDateTimeString();
        $latestAttendance = Attendance::where('employee_id', $data['employee_id'])
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latestAttendance && !$latestAttendance['check_out']) {
            $data['attendance_id'] = $latestAttendance['id'];
            $this->attendanceDetailDataRepository->create($data);
            return response()->json(['error' => 'Already in check in'], 400);
        }

        $checkInData['check_in'] = Carbon::now();
        $checkInData['working_from'] = $data['working_from'];
        $checkInData['in_comment'] = 'working from' . ' ' . $data['working_from'];
        $checkInData['employee_id'] = $data['employee_id'];

        $checkIn = $this->attendanceRepository->create($checkInData);
        $data['attendance_id'] = $checkIn['id'];
        $this->attendanceDetailDataRepository->create($data);
        return $checkIn;
    }

    private function checkOut($data)
    {
        $today = Carbon::today()->toDateTimeString();
        $latestAttendance = Attendance::where('employee_id', $data['employee_id'])
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->first();

        // $data['attendance_id'] = 15;
        // $this->attendanceDetailDataRepository->create($data);
        if (!$latestAttendance) {
            return response()->json(['error' => 'Not checked in at'], 400);
        }
        if ($latestAttendance && !$latestAttendance['check_out']) {
            $checkOutData['check_out'] = Carbon::now();
            $checkOutData['out_comment'] = 'Leaved the office premise';

            $checkOut = $this->attendanceRepository->update($checkOutData, $latestAttendance['id']);
            $data['attendance_id'] = $latestAttendance['id'];
            // $this->attendanceDetailDataRepository->create($data);
            return $checkOut;
        }
        $data['attendance_id'] = $latestAttendance['id'];
        // $this->attendanceDetailDataRepository->create($data);
        return response()->json(['error' => 'Already in check out'], 400);
    }


    public function getAttendanceLogs($data)
    {
        if (isset($data['date'])) {
            $startDate = $data['date'];
        } else {
            $startDate = date('Y-m-d');
        }
        $user = Auth::user();
        $employeeId = isset($data['employee_id']) ? $data['employee_id'] : $user['employee_id'];

        $logs = DB::table('attendance')
            ->select(
                'in_comment as attendance_in_comment',
                'out_comment as attendance_out_comment',
                'check_in as attendance_check_in',
                'check_out as attendance_check_out',
            )
            ->where('employee_id', $employeeId)
            ->whereDate('created_at', $startDate)
            ->get();


        $inAt = $logs->isNotEmpty() ? $logs[0]->attendance_check_in : null;
        $outAt = $logs->isNotEmpty() ? $logs[count($logs) - 1]->attendance_check_out : null;

        $response = [
            'logs' => $logs,
            'in_at' => $inAt,
            'out_at' => $outAt,
        ];

        return response()->json($response);
    }

    function paginationMetaData($data, $total_items, $page, $limit)
    {
        return [
            'total_items' => $total_items,
            'items_in_page' => $data,
            'current_page' => $page,
            'total_pages' => ceil($total_items / $limit),
        ];
    }

    function pagination($page, $limit)
    {
        return [
            'take' => $limit,
            'skip' => ($page - 1) * $limit,
        ];
    }

    public function getEmployeeAttendance($data)
    {
        $page = $data['page'];
        $limit = $data['limit'];
        $offset = $data['offset'];
        $month = $data['month'];
        $year = $data['year'];
        $search = isset($data['search']) ? $data['search'] : '';
        $sortBy = $data['sortBy'];
        $order = $data['order'];

        $paginationParams = $this->pagination($page, $limit);

        $employees = Employee::with(['attendances' => function ($query) use ($month, $year) {
            $query->whereMonth('check_in', $month)
                ->whereYear('check_in', $year);
        }]);

        if (!empty($search)) {
            $employees->where('employee.name', 'LIKE', '%' . $search . '%');
        }
        // Get the paginated results
        $employees = $employees->paginate($limit);

        $employees->appends(['month' => $month, 'year' => $year]);

        $result = [
            'data' => [],
            'meta' => [
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total(),
            ],
        ];

        foreach ($employees as $employee) {
            $attendanceData = [
                'id' => $employee->id,
                'name' => $employee->name,
                'profile_picture' => $employee->profile_picture,
                'attendance' => [],
                'leave' => []
            ];

            foreach ($employee->attendances as $attendance) {
                $attendanceData['attendance'][] = [
                    'id' => $attendance->id,
                    'check_in' => $attendance->check_in,
                    'check_out' => $attendance->check_out,
                ];
            }

            $result['data']['employees'][] = $attendanceData;
        }

        $jsonResult = json_encode($result);

        return $jsonResult;
    }
}
