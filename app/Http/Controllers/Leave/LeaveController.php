<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\AttendanceCreateRequest;
use App\Services\Attendance\CheckInCheckOutService;
use Illuminate\Http\Request;


class LeaveController extends Controller
{
    //
    use ApiResponser;


    public function checkInCheckOut(AttendanceCreateRequest $request, CheckInCheckOutService $checkInCheckOutService)
    {
        $data = $request->all();
        return $checkInCheckOutService->evaluateCheckInCheckOut($data);
    }

    public function getAttendanceLog(Request $request, CheckInCheckOutService $checkInCheckOutService)
    {
        $data = $request->query();
        return $checkInCheckOutService->getAttendanceLogs($data);
    }
}
