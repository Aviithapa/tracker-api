<?php


namespace App\Services\Attendance;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetAttendance
{


    public function getActivityLog($data)
    {
        // dd($data);
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
                'check_out as attendance_check_out'
            )
            ->where('employee_id', $employeeId)
            ->whereDate('created_at', $startDate)
            ->orderBy('check_in', 'asc') // Order by check-in timestamp in ascending order
            ->get();

        dd($logs);
        $firstCheckIn = $logs->isEmpty() ? null : $logs->first()->attendance_check_in;
        $lastCheckOut = $logs->isEmpty() ? null : $logs->last()->attendance_check_out;


        $response = [
            'logs' => $logs,
            'in_at' =>  $firstCheckIn,
            'out_at' => $lastCheckOut,
        ];

        return response()->json($response);
    }
}
