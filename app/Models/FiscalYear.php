<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;
    protected $table = 'fiscal_year';
    protected $fillable = [
        'name',
        'start_date_english',
        'end_date_english',
        'start_date_nepali',
        'end_date_nepali',
        'status',
    ];
}
