<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = [
        'check_in',
        'check_out',
        'in_comment',
        'out_comment',
        'working_from',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
