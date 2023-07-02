<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area';
    protected $fillable = [
        'latitude',
        'longitude',
        'office_id'
    ];

    public function office()
    {
        return $this->belongsTo(Offices::class);
    }
}
