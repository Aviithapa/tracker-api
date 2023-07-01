<?php

namespace App\Repositories\Imei;


use App\Models\Imei;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentImeiRepository extends RepositoryImplementation implements ImeiRepository
{

    public function getModel()
    {
        return new Imei();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
