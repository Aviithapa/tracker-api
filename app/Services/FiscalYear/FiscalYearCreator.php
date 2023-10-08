<?php

namespace App\Services\FiscalYear;

use App\Repositories\FiscalYear\FiscalYearRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class  OfficeGetter
 * @package App\Services\Office
 */
class FiscalYearCreator
{
    /**
     * @var fiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     *  OfficeGetter constructor.
     * @param FiscalYearRepository $fiscalYearRepository
     */
    public function __construct(FiscalYearRepository $fiscalYearRepository)
    {
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    public function store($data)
    {
        $fiscalYear = $this->fiscalYearRepository->create($data);
        if ($fiscalYear === false) {
            return response()->json(['error' => 'Internal Error'], 500);
        }
        return $fiscalYear;
    }
}
