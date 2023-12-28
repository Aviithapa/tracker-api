<?php

namespace App\Repositories\Designation;

use App\Repositories\Repository;
use Illuminate\Http\Request;

interface DesignationRepository  extends  Repository
{
    public function getPaginatedList(Request $request);
}
