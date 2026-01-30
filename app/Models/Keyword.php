<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable=[
        'title',
        'title_en',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
