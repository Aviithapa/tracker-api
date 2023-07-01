<?php

namespace App\Repositories\Employee;

use App\Repositories\Repository;
use Illuminate\Http\Request;

interface EmployeeRepository  extends  Repository
{
    public function getPaginatedList(Request $request);
}
