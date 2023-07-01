<?php

namespace App\Repositories\AttendanceDetailData;

use App\Models\AttendanceDetailData;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentAttendanceDetailDataRepository extends RepositoryImplementation implements AttendanceDetailDataRepository
{

    public function getModel()
    {
        return new AttendanceDetailData();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
