<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
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
<<<<<<< Updated upstream
        'status'
=======
>>>>>>> Stashed changes
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType()
    {
<<<<<<< Updated upstream
        return $this->belongsTo(LeaveType::class, 'leaveType_id', 'id');
=======
        return $this->belongsTo(LeaveType::class, 'leaveType_id');
>>>>>>> Stashed changes
    }
}
