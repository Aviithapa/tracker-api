<?php

namespace App\Repositories\Holiday;

use App\Models\Holiday;
use App\Repositories\Holiday\HolidayRepository;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentHolidayRepository extends RepositoryImplementation implements HolidayRepository
{

    public function getModel()
    {
        return new Holiday();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
