<?php

namespace App\Repositories\LeaveType;

use App\Models\Employee;
use App\Models\LeaveType;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentLeaveTypeRepository extends RepositoryImplementation implements LeaveTypeRepository
{

    public function getModel()
    {
        return new LeaveType();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
