<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponser;
use App\Http\Requests\Office\CreateOfficeRequest;
use App\Http\Resources\Office\OfficeResource;
use App\Http\Resources\User\UserResource;
use App\Services\Area\AreaImport;
use App\Services\Office\OfficeCreator;
use App\Services\Office\OfficeGetter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
    use ApiResponser;

    public function index(Request  $request, OfficeGetter $officeGetter)
    {
        return OfficeResource::collection($officeGetter->getPaginatedList($request));
    }

    public function show(OfficeGetter $officeGetter, $id)
    {
        return $officeGetter->show($id);
    }

    public function store(CreateOfficeRequest $request, OfficeCreator $officeCreator, AreaImport $areaImport)
    {
        $data = $request->all();

        DB::beginTransaction();

        try {
            $office = $officeCreator->store($data);
            if ($office === false) {
                DB::rollBack();
                return response()->json(['error' => 'Internal Error'], 500);
            }

            $data['office_id'] = $office->id;

            $area = $areaImport->importArea($data);

            DB::commit();

            return $this->successResponse(
                OfficeResource::make($office),
                __('Office created successfully'),
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this->successResponse(
            UserResource::make($officeCreator->store($data)),
            __('Office created successfully'),
            Response::HTTP_CREATED
        );
    }
}
