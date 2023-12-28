<?php

namespace App\Repositories\Designation;

use App\Models\Designation;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentDesignationRepository extends RepositoryImplementation implements DesignationRepository
{

    public function getModel()
    {
        return new Designation();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
