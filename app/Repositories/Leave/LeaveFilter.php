<?php

namespace App\Repositories\Leave;

use App\Infrastructure\Filters\BaseFilter;

class LeaveFilter extends BaseFilter
{
    /**
     * Filter is allowed with following parameters.
     *
     * @var array
     */
    protected $filters = ['status', 'employee_id', 'leaveType_id', 'start_date', 'end_date', 'search'];


    /**
     * keyword
     *
     * @return void
     */
    public function status()
    {
        if ($this->request->has('status')) {
            $this->builder->where('status', 'LIKE', '%' . $this->request->get('status') . '%');
        }
    }

    /**
     * keyword
     *
     * @return void
     */
    public function search()
    {
        $searchTerm = $this->request->get('search');
        if ($this->request->has('search')) {
            $this->builder->whereHas('employee', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }
    }

    /**
     * keyword
     *
     * @return void
     */
    public function leaveTypeId()
    {
        if ($this->request->has('leaveType_id')) {
            $this->builder->where('leaveType_id', 'LIKE', '%' . $this->request->get('leaveType_id') . '%');
        }
    }

    /**
     * keyword
     *
     * @return void
     */
    public function startDate()
    {
        if ($this->request->has('start_date')) {
            $this->builder->where('start_date', '>=', $this->request->get('start_date'));
        }
    }

    /**
     * keyword
     *
     * @return void
     */
    public function endDate()
    {
        if ($this->request->has('end_date')) {
            $this->builder->where('end_date', '<=', $this->request->get('end_date'));
        }
    }
}
