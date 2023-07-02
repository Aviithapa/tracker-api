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
class OfficeCreator
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

    public function store($data)
    {
        $employee = $this->officeRepository->create($data);
        if ($employee === false) {
            return response()->json(['error' => 'Internal Error'], 500);
        }
        return $employee;
    }
}
