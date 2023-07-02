<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'name',
        'address',
        'type',
    ];

    public function area()
    {
        return $this->hasMany(Area::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
