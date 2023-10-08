<?php

namespace App\Services\FiscalYear;

use App\Repositories\FiscalYear\FiscalYearRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class  OfficeGetter
 * @package App\Services\Office
 */
class FiscalYearGetter
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

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList($request): LengthAwarePaginator
    {
        return $this->fiscalYearRepository->getPaginatedList($request);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->fiscalYearRepository->findById($id);
    }
}
