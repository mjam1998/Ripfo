<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationFiled extends Model
{
    protected $fillable = [
        'name',
        'name_en'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
