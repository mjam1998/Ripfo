<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleScore extends Model
{
    protected $fillable = [
        'article_id',
        'innovation',
        'subject_importance',
        'result_usage',
        'struct_science',
        'write_principle',
        'science_content',
        'resource',
        'pen',
        'update',
        'prestige',
        'total_score',
    ];

    public function article(){
        return $this->belongsTo(Article::class, 'article_id');
    }

}
