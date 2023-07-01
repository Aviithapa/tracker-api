<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Api\ApiResponser;
use App\Http\Controllers\Controller;
use App\Services\Area\AreaImport;
use Illuminate\Http\Request;


class AreaController extends Controller
{
    //
    use ApiResponser;


    public function importArea(Request $request, AreaImport $areaImport)
    {
        $data = $request->all();
        $officeArea =   $areaImport->importArea($data);
        return response()->json(['success' => 'Office Imported Successfully', 'data' => $officeArea], 200);
    }
}
