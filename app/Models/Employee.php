<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use HasFilter;

    protected $table = 'employee';
    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'address',
        'permanent_address',
        'phone_number',
        'gender',
        'marital_status',
        'joined_date',
        'termination_date',
        'citizenship_number',
        'profile_picture',
        'office_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function office()
    {
        return $this->belongsTo(Offices::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
