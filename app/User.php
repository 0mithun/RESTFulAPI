<?php

namespace App;

use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens;

    protected $dates = ['deleted_at'];

    public $transformer = UserTransformer::class;

    const VERIFIED_USER = 'true';
    const UNVERIFIED_USER = 'false';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin','verified','verification_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        //'verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setNameAttribute($value){
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute($name){
        return ucwords($name);
    }

    public function getEmailAttributes($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    


    public function isVerified(){
        return $this->verified == User::VERIFIED_USER;
    }
    public function isUnVerified(){
        return $this->verified == User::UNVERIFIED_USER;
    }

    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }
    public function isRegular(){
        return $this->admin == User::REGULAR_USER;
    }

    public static function generateVerificationCode(){
        return str_random(40);
    }
}
