<?php

namespace App\Services\FiscalYear;

use App\Repositories\FiscalYear\FiscalYearRepository;

/**
 * Class  FiscalYearCreator
 * @package App\Services\FiscalYear
 */
class FiscalYearCreator
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


    public function store($data)
    {

        $employee = $this->fiscalYearRepository->create($data);
        if ($employee === false) {
            return response()->json(['error' => 'Internal Error'], 500);
        }
        return $employee;
    }
}
