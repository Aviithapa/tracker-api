<?php

namespace App\Http\Controllers\FiscalYear;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponser;
use App\Http\Requests\FiscalYear\CreateFiscalYearRequest;
use App\Http\Resources\FiscalYear\FiscalYearResource;
use App\Services\FiscalYear\FiscalYearCreator;
use App\Services\FiscalYear\FiscalYearGetter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FiscalYearController extends Controller
{
    use ApiResponser;

    public function index(Request  $request, FiscalYearGetter $fiscalYearGetter)
    {
        return FiscalYearResource::collection($fiscalYearGetter->getPaginatedList($request));
    }

    public function show(FiscalYearGetter $fiscalYearGetter, $id)
    {
        return $fiscalYearGetter->show($id);
    }

    public function store(CreateFiscalYearRequest $request, FiscalYearCreator $fiscalYearCreator)
    {
        $data = $request->all();

        DB::beginTransaction();

        try {
            $fiscal = $fiscalYearCreator->store($data);
            if ($fiscal === false) {
                DB::rollBack();
                return response()->json(['error' => 'Internal Error'], 500);
            }

            DB::commit();

            return $this->successResponse(
                FiscalYearResource::make($fiscal),
                __('Fiscal Year created successfully'),
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        
    }
}
