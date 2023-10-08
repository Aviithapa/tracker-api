<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Leave\LeaveCreateRequest;
use App\Http\Resources\Leave\LeaveResource;
use App\Http\Resources\Leave\LeaveTypeResource;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Services\Leave\LeaveCreator;
use App\Services\Leave\LeaveGetter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    //
    use ApiResponser;


    public function index(Request  $request, LeaveGetter $leaveGetter)
    {
        return LeaveResource::collection($leaveGetter->getPaginatedList($request));
    }


    public function show(LeaveGetter $leaveGetter, $id)
    {
        return $leaveGetter->show($id);
    }

    public function store(Request $request, LeaveGetter $leaveGetter, LeaveCreator $leaveCreator)
    {
        $data = $request->all();

        // $employee = Employee::all()->where('id', $data['employee_id'])->first();

        // $overlapping = $leaveGetter->checkOverlappingLeaves($data['employee_id'], $data['end_date'], $data['start_date']);
        // if ($overlapping->isNotEmpty()) {
        //     return response()->json(['message' => 'Overlapping leaves found'], 400);
        // }

        $start_date = Carbon::parse($data['start_date']);
        $end_date = Carbon::parse($data['end_date']);
        $data['number_of_days'] = $end_date->diffInDays($start_date) + 1;
        $data['leaveType_id'] = '1';

        // dd($data)
        // return $data;
        return  $leaveCreator->store($data);
    }

<<<<<<< Updated upstream
    public function EmployeeLeaveApply(Request $request, LeaveCreator $leaveCreator)
    {
        $data = $request->all();

        $employee = Employee::all()->where('id', Auth::user()->employee_id)->first();

        $start_date = Carbon::parse($data['start_date']);
        $end_date = Carbon::parse($data['end_date']);
        $data['number_of_days'] = $end_date->diffInDays($start_date) + 1;
        $data['employee_id'] = $employee->id;
        return  $leaveCreator->store($data);
    }

    public function getLeaveByEmployeeId(LeaveGetter $leaveGetter)
    {
        $id = Auth::user()->employee_id;
        return  LeaveResource::collection($leaveGetter->getLeaveByEmployeeId($id));
    }

    public function getLeaveType()
    {
        $leaveType =  LeaveType::all();
        return LeaveTypeResource::collection($leaveType);
    }
=======
    public function getEmployee(Request $request, LeaveGetter $leaveGetter, $id){
        $leave = $leaveGetter->show($id);
        return $leave->employee;
    }

    public function getLeaveType(Request $request, LeaveGetter $leaveGetter, $id){
        $leave = $leaveGetter->show($id);
        return $leave->leaveType;
    }

>>>>>>> Stashed changes
}
