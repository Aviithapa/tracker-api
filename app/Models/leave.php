<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{

    use HasFactory;
    use HasFilter;

    protected $table = 'leave';
    protected $fillable = [
        'reason',
        'reject_reason',
        'requested_on',
        'start_date',
        'end_date',
        'shift',
        'employee_id',
        'leaveType_id',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leaveType_id', 'id');
    }
}
