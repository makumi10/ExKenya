<?php

namespace App\Models;

use App\Models\UserDetails;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jcc\LaravelVote\Traits\Voter;


class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;
    use Voter;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function details()
    {
        return $this->hasOne(UserDetails::class);
    }
    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    // public function myFavourites()
    // {
    //     if ($this->favourites) {
    //         # code...
    //     }
    // }
    
    public function userImage()
    {
        if ($this->details) {
            return $this->details->image;
        }
        return 'default.jpg';
    }
}