<?php

namespace App\Services\FiscalYear;

use App\Repositories\FiscalYear\FiscalYearRepository;

/**
 * Class  FiscalYearUpdator
 * @package App\Services\FiscalYear
 */
class FiscalYearUpdator
{
    /**
     * @var fiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * FiscalYearGetter constructor.
     * @param FiscalYearRepository $fiscalYearRepository
     */
    public function __construct(FiscalYearRepository $fiscalYearRepository)
    {
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    public function update($data)
    {
        $fiscalYear =  $this->fiscalYearRepository->findById($data['fiscalYear_id']);

        if ($fiscalYear) {
            $employeeUpdate = $this->fiscalYearRepository->update($data, $fiscalYear->id);
            if ($employeeUpdate === false) {
                return response()->json(['error' => 'Internal Error'], 500);
            }
            return $fiscalYear;
        }
        return response()->json(['error' => 'Not Found'], 404);
    }

    public function updateStatus($data)
    {
        $fiscalYear =  $this->fiscalYearRepository->findById($data['fiscalYear_id']);

        if ($fiscalYear) {
            $employeeUpdate = $this->fiscalYearRepository->update($data, $fiscalYear->id);
            if ($employeeUpdate === false) {
                return response()->json(['error' => 'Internal Error'], 500);
            }
            return $fiscalYear;
        }
        return response()->json(['error' => 'Not Found'], 404);
    }
}
