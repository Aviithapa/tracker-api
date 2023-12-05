<?php

namespace App\Repositories\Employee;

use App\Infrastructure\Filters\BaseFilter;

class EmployeeFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['search', 'email', 'phone_number', 'date_of_birth'];


    /**
     * keyword
     *
     * @return void
     */
    public function search()
    {
        if ($this->request->has('search')) {
            $this->builder->where('name', 'LIKE', '%' . $this->request->get('search') . '%');
        }
    }

    /**
     * keyword
     *
     * @return void
     */
    public function email()
    {
        if ($this->request->has('email')) {
            $this->builder->where('email', 'LIKE', '%' . $this->request->get('email') . '%');
        }
    }
    /**
     * keyword
     *
     * @return void
     */
    public function phoneNumber()
    {
        if ($this->request->has('phone_number')) {
            $this->builder->where('phone_number', 'LIKE', '%' . $this->request->get('phone_number') . '%');
        }
    }

    public function dateOfBirth()
    {
        if ($this->request->has('date_of_birth')) {
            $this->builder->where('date_of_birth', 'LIKE', '%' . $this->request->get('date_of_birth') . '%');
        }
    }
}
