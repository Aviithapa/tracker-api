<?php

namespace App\Repositories\Office;

use App\Repositories\Repository;
use Illuminate\Http\Request;

interface OfficeRepository  extends  Repository
{
    public function getPaginatedList(Request $request);
}
