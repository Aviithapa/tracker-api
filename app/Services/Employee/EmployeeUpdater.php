<?php

namespace App\Services\Employee;

use App\Repositories\Employee\EmployeeRepository;

/**
 * Class EmployeeUpdater
 * @package App\Services\Apartment
 */
class EmployeeUpdater
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

    public function update($data)
    {
        $employee =  $this->employeeRepository->findById($data['employee_id']);

        if ($employee) {
            $employeeUpdate = $this->employeeRepository->update($data, $employee->id);
            if ($employeeUpdate === false) {
                return response()->json(['error' => 'Internal Error'], 500);
            }
            return $employee;
        }
        return response()->json(['error' => 'Not Found'], 404);
    }
}
