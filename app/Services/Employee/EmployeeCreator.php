<?php

namespace App\Services\Employee;

use App\Repositories\Employee\EmployeeRepository;

/**
 * Class EmployeeCreator
 * @package App\Services\Apartment
 */
class EmployeeCreator
{
    /**
     * @var EmployeeRepository
     */
    protected $employeeRepository;

    /**
     * EmployeeCreator constructor.
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function store($data)
    {

        $employee = $this->employeeRepository->create($data);
        if ($employee === false) {
            return response()->json(['error' => 'Internal Error'], 500);
        }
        return $employee;
    }
}
