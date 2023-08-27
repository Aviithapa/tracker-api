<?php

namespace App\Repositories\Leave;

use App\Repositories\Repository;
use Illuminate\Http\Request;

interface LeaveRepository  extends  Repository
{
    public function getPaginatedList(Request $request);
}
