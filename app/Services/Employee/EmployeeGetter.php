<?php

namespace App\Services\Student;

use App\Repositories\Employee\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ApartmentGetter
 * @package App\Services\Apartment
 */
class EmployeeGetter
{
    /**
     * @var employeeRepository
     */
    protected $employeeRepository;

    /**
     * StudentGetter constructor.
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList($request): LengthAwarePaginator
    {
        return $this->employeeRepository->getPaginatedList($request);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->employeeRepository->findById($id);
    }

    public function getStudentBasedOnOffice($id)
    {
        return $this->employeeRepository->getAll()->where('office_id', $id);
    }
}
