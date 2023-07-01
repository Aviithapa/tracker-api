<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeFiles extends Model
{
    protected $table = 'employee_files';

    protected $fillable = [
        'name',
        'description',
        'document',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
