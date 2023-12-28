<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\Leave\LeaveTypeResource;
use App\Services\LeaveType\LeaveTypeCreator;
use App\Services\LeaveType\LeaveTypeGetter;
use App\Services\LeaveType\LeaveTypeUpdater;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, LeaveTypeGetter $leaveTypeGetter)
    {
        return LeaveTypeResource::collection($leaveTypeGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, LeaveTypeCreator $leaveTypeCreator)
    {

        $data = $request->all();
        return $this->successResponse(LeaveTypeResource::make($leaveTypeCreator->store($data)));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, LeaveTypeUpdater $leaveTypeUpdater)
    {
        //
        $data = $request->all();
        return $this->successResponse(LeaveTypeResource::make($leaveTypeUpdater->update($data, $id)));
    }
}
