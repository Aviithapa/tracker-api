<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveType extends Model
{

    protected $table = 'leave_type';
    protected $fillable = [
        'name', 'fiscal_year_id', 'alloted_days', 'max_carryover', 'encashmentLimit'
    ];

    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    public function FiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }
}
