<?php

namespace App\Http\Controllers\Designation;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\Designation\DesignationResource;
use App\Services\Designation\DesignationCreator;
use App\Services\Designation\DesignationGetter;
use App\Services\Designation\DesignationUpdater;
use Illuminate\Http\Request;

class DesignationController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DesignationGetter $designationGetter)
    {
        return DesignationResource::collection($designationGetter->getPaginatedList($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, DesignationCreator $designationCreator)
    {
        $data = $request->all();
        return $this->successResponse(DesignationResource::make($designationCreator->store($data)));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, DesignationUpdater $designationUpdater)
    {
        $data = $request->all();
        return $this->successResponse(DesignationResource::make($designationUpdater->update($data, $id)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
