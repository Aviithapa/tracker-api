<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Services\Attendance\AddNewAttendanceByAdmin;
use App\Services\Attendance\CheckInCheckOutService;
use App\Services\Attendance\GetAttendance;
use Illuminate\Http\Request;

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


    public function newAttendanceByAdmin(Request $request, AddNewAttendanceByAdmin $addNewAttendanceByAdmin)
    {
        $data = $request->all();
        return $addNewAttendanceByAdmin->addAttendanceByAdmin($data);
    }


    public function deleteEmployeeAttendanceForDate(Request $request, AddNewAttendanceByAdmin $addNewAttendanceByAdmin)
    {
        $data = $request->all();
        return $addNewAttendanceByAdmin->deleteEmployeeAttendanceForDate($data);
    }


    public function getAttendanceLogOfUser(Request $request, GetAttendance $getAttendance)
    {
        $data = $request->all();
        return $getAttendance->getActivityLog($data);
    }
}
