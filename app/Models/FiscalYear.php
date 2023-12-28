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
        'start_year_english',
        'end_year_english',
        'start_year_nepali',
        'end_year_nepali',
        'status',
    ];
}
