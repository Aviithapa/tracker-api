<?php

namespace App\Services\Office;

use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Office\OfficeRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class  OfficeGetter
 * @package App\Services\Office
 */
class OfficeGetter
{
    /**
     * @var officeRepository
     */
    protected $officeRepository;

    /**
     *  OfficeGetter constructor.
     * @param OfficeRepository $officeRepository
     */
    public function __construct(OfficeRepository $officeRepository)
    {
        $this->officeRepository = $officeRepository;
    }

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList($request): LengthAwarePaginator
    {
        return $this->officeRepository->getPaginatedList($request);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->officeRepository->findById($id);
    }
}
