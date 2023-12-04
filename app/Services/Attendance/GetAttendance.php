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

    public function getOfficeAttendance($data){
        $details = $this->muncipalityDetail();
        $main = $this->municipalityOverview();
        
        $toReturn = [
            'main' => $main,
            'details' => $details
        ];

        return $toReturn;
    }

    public function municipalityOverview(){
        $offices = DB::table('offices')->get();
        $today = Carbon::today()->toDateString();
        $attendance = DB::table('attendance')
                            ->where('check_in',$today)
                            ->get()->count();
        $leave = DB::table('leave')
                        ->whereDate('start_date','<=', $today)
                        ->whereDate('end_date','>=', $today)
                        ->get()->count();
        $employeeCount = DB::table('employee')->whereNull('termination_date')->get()->count();
        $main = [
            'totalOffice' => $offices->count(),
            'totalEmployee' => $employeeCount,
            'totalAttendance' => $attendance,
            'totalLeave' => $leave
        ];

        return $main;
    }

    public function muncipalityDetail(){

        $offices = DB::table('offices as off')
                            ->select('off.id','e.id as employee_id','off.ward_id','wards.name')
                            ->leftJoin('wards','wards.id','off.ward_id')
                            ->join('employee as e','e.office_id','off.id')
                            ->whereNull('e.termination_date')
                            ->whereNotNull('ward_id')
                            ->get()->groupBy('ward_id');
        $data = [];

        foreach($offices as $key => $office){
            $employeeIds = $office->pluck('employee_id')->toArray();
            $totalEmployee = count($employeeIds);
            $today = Carbon::today()->toDateString();
            $attendance = DB::table('attendance')
                                ->whereIn('employee_id',$employeeIds)
                                ->where('check_in',$today)
                                ->get()->count();

            $leave = DB::table('leave')
                        ->whereDate('start_date','<=', $today)
                        ->whereDate('end_date','>=', $today)
                        ->get()->count();

            $data[$key]['ward'] = $office[0]->name;
            $data[$key]['attendance'] = $attendance;
            $data[$key]['employees'] = $totalEmployee;
            $data[$key]['leave'] = $leave;
            
        }
        return array_values($data);
    }
}
