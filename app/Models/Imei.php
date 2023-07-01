<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imei extends Model
{
    protected $table = 'imei';
    protected $fillable = [
        'imei_number',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
