<?php

namespace App\Repositories\FiscalYear;

use App\Repositories\Repository;
use Illuminate\Http\Request;

interface FiscalYearRepository  extends  Repository
{
    public function getPaginatedList(Request $request);
}
