<?php

namespace App\Http\Controllers\Holiday;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponser;
use App\Http\Requests\Holiday\CreateHolidayRequest;
use App\Http\Resources\Holiday\HolidayResource;
use App\Services\Holiday\HolidayCreator;
use App\Services\Holiday\HolidayGetter;
use App\Services\Holiday\HolidayUpdater;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HolidayController extends Controller
{
    use ApiResponser;

    public function index(Request  $request, HolidayGetter $holidayGetter)
    {
        return HolidayResource::collection($holidayGetter->getPaginatedList($request));
    }

    public function show(HolidayGetter $holidayGetter, $id)
    {
        return $holidayGetter->show($id);
    }

    public function update(CreateHolidayRequest $createHolidayRequest,  HolidayUpdater $holidayUpdater, $id)
    {
        $data = $createHolidayRequest->all();
        return $this->successResponse(
            HolidayResource::make($holidayUpdater->update($data, $id)),
            __('Holiday is updated successfully'),
            Response::HTTP_CREATED
        );
    }

    public function store(CreateHolidayRequest $request, HolidayCreator $holidayCreator)
    {
        $data = $request->all();
        return  $holidayCreator->store($data);
    }
}
