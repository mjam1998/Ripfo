<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Required extends Model
{
    protected $fillable = [
        'is_orcid_required',
    ];
    protected $casts = [
        'is_orcid_required' => 'boolean',
    ];
}
