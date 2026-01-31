<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\AcademicRank;
use App\Enums\Education;
use App\Enums\Title;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'name',
        'name_en',
        'email',
        'education',
        'education_filed_id',
        'mobile',
        'fax',
        'academic_rank',
        'phone',
        'research_favorite',
        'url',
        'postal_code',
        'city',
        'city_en',
        'organ',
        'organ_en',
        'national_code',
        'user_name',
        'is_juror_want',
        'orcid',
        'email_help',

        'is_verified',
        'user_description',
        'bank_name',
        'bank_account',
        'bank_card',
        'password',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [

        'title'=>Title::class,
        'password' => 'hashed',
        'education'=>Education::class,
        'academic_rank'=>AcademicRank::class,
        'is_juror_want'=>'boolean',
        'is_verified'=>'boolean',

    ];

    public function educationFiled(){
        return $this->belongsTo(EducationFiled::class);
    }

    public function  paids()
    {
        return $this->hasMany(Paid::class);
    }
    public function articles(){
        return $this->hasMany(Article::class);
    }
    public function jurorArticles()
    {
        return $this->hasMany(Article::class, 'juror_id');
    }
}
