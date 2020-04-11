<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function votes() {
        return $this->hasMany('App\Votes');
    }

    public function getFullNameAttribute() {
        return "$this->name $this->lastname";
    }

    public function scopeSearch($query, $keyword) {
        if($keyword){
            return $query->where('name', 'like', "%$keyword%")
                ->orWhere('lastname', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%")
                ->orWhereHas('roles', function($role) use ($keyword) {
                    $role->where('name', 'like', "%$keyword%");
                });
        }
    }

}
