<?php

namespace App\Repositories\Offices;

use App\Models\Employee;
use App\Models\Offices;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentOfficesRepository extends RepositoryImplementation implements OfficesRepository
{

    public function getModel()
    {
        return new Offices();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
