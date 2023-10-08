<?php

namespace App\Repositories\Office;

use App\Models\FiscalYear;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\FiscalYear\FiscalYearRepository;

class EloquentFiscalYearRepository extends RepositoryImplementation implements FiscalYearRepository
{

    public function getModel()
    {
        return new FiscalYear();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
