<?php

namespace App\Repositories\Employee;

use App\Models\Employee;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentEmployeeRepository extends RepositoryImplementation implements EmployeeRepository
{

    public function getModel()
    {
        return new Employee();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
