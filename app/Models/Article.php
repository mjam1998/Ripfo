<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
      'user_id',
      'period_number_id',
      'juror_id',
      'juror_offer_id',
      'code',
      'title',
      'title_en',
      'summary',
      'summary_en',
      'writers',
      'writers_en',
      'doi',
      'file_primary',
      'file_secondary',
      'juror_file',
      'writer_des_juror',
      'juror_des_writer',
        'juror_des_sec',
        'juror_des_admin',
        'visitor_number',
        'status',
        'period_number_pages'


    ];
    protected $casts = [
      'status'=>ArticleStatus::class,
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function periodNumber(){
        return $this->belongsTo(PeriodNumber::class);
    }
    public function juror()
    {
        return $this->belongsTo(User::class, 'juror_id');
    }
    public function jurorOffer(){
        return $this->belongsTo(User::class, 'juror_offer_id');
    }
    public function articleScore(){
        return $this->hasOne(ArticleScore::class);
    }
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class);
    }
}
