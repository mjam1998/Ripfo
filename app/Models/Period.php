<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'is_current'
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];
    public function periodNumbers()
    {
        return $this->hasMany(PeriodNumber::class);
    }
}
