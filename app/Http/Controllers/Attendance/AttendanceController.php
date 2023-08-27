<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\AttendanceCreateRequest;
use App\Services\Attendance\CheckInCheckOutService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    //
    use ApiResponser;


    public function checkInCheckOut(Request $request, CheckInCheckOutService $checkInCheckOutService)
    {
        $data = $request->all();
        return $checkInCheckOutService->evaluateCheckInCheckOut($data);
    }

    public function getAttendanceLog(Request $request, CheckInCheckOutService $checkInCheckOutService)
    {
        $data = $request->query();
        return $checkInCheckOutService->getAttendanceLogs($data);
    }


    public function getEmployeeAttendance(Request $request, CheckInCheckOutService $checkInCheckOutService)
    {
        $data = $request->query();
        return $checkInCheckOutService->getEmployeeAttendance($data);
    }
}
