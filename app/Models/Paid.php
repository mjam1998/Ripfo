<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    protected  $fillable = [
      'user_id',
      'amount',
      'bank_ref_id',
      'issue_tracking_number',
      'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
