<?php

namespace App\Repositories\Attendance;

use App\Models\Area;
use App\Models\Attendance;
use App\Models\Media;
use App\Repositories\RepositoryImplementation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentAttendanceRepository extends RepositoryImplementation implements AttendanceRepository
{

    public function getModel()
    {
        return new Attendance();
    }

    public function getPaginatedList(Request $request, array $columns = array('*')): LengthAwarePaginator
    {
        $limit = $request->get('limit', config('app.per_page'));
        return $this->getModel()->newQuery()
            ->latest()
            ->paginate($limit);
    }
}
