<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'preferences',
        'api_token',
        'avatar',
        'user_type',
        'liked_posts',
        'disliked_posts',
        'favourite_posts',
        'favourite_categories'
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

    public function posts()
    {
        return $this->hasMany('App\Modele\Post', 'author_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Modele\Comment', 'author_id', 'id');
    }

    public function getUserImageAttribute($value)
    {
        return (strpos($this->avatar, 'http') === 0) ? $this->avatar : Storage::get($this->avatar);
    }
}
