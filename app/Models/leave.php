<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $table = 'leave';
    protected $fillable = [
        'reason',
        'reject_reason',
        'requested_on',
        'start_date',
        'end_date',
        'shift',
        'employee_id',
        'leaveType_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
