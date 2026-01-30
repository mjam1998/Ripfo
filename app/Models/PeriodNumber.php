<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodNumber extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'period_id',
        'pages',
        'pages_en',
        'image',
        'time_name',
        'time_name_en',
    ];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
