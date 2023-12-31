<?php

namespace App\Repositories\LeaveType;

use App\Repositories\Repository;
use Illuminate\Http\Request;

interface LeaveTypeRepository  extends  Repository
{
    public function getPaginatedList(Request $request);
}
