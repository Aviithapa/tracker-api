<?php

namespace App\Repositories\Leave;

use App\Models\Employee;
use App\Models\Leave;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentLeaveRepository extends RepositoryImplementation implements LeaveRepository
{

    public function getModel()
    {
        return new Leave();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
