<?php

namespace App\Http\Controllers\FiscalYear;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\FiscalYear\CreateFiscalYearRequest;
use App\Http\Resources\FiscalYear\FiscalYearResource;
use App\Services\FiscalYear\FiscalYearCreator;
use App\Services\FiscalYear\FiscalYearGetter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FiscalYearController extends Controller
{
    //
    use ApiResponser;

    public function index(Request  $request, FiscalYearGetter $fiscalYearGetter)
    {
        return FiscalYearResource::collection($fiscalYearGetter->getPaginatedList($request));
    }

    public function show(FiscalYearGetter $fiscalYearGetter, $id)
    {
        return $fiscalYearGetter->show($id);
    }

    public function store(CreateFiscalYearRequest $createFiscalYearRequest, FiscalYearCreator $fiscalYearCreator)
    {
        $data = $createFiscalYearRequest->all();
        return $this->successResponse(
            FiscalYearResource::make($fiscalYearCreator->store($data)),
            __('Fiscal Year created successfully'),
            Response::HTTP_CREATED
        );
    }
}
