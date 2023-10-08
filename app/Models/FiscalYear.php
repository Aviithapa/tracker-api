<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date_en',
        'start_date_np',
        'end_date_en',
        'end_date_np',
        'status',
    ];
}
