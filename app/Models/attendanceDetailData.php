<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDetailData extends Model
{
    use HasFactory;
    protected $table = 'attendance_detail_data';
    protected $fillable = [
        'wifi_ssid',
        'latitude',
        'longitude',
        'attendance_id',
        'battery_percentage'
    ];

    public function attendanceDetailData()
    {
        return $this->belongsTo(Attendance::class);
    }
}
