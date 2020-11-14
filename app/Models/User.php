<?php

namespace App\Models;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
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

    // auto create a profile once user registered and 
    // title of profile assigned initially to username
    protected static function boot()
    {

        parent::boot();

        static::created(function ($user) {

            $user->profile()->create([

                'title' => $user->username,
            ]);
                //send an email to user after registering
                Mail::to($user->email)->send(new NewUserWelcomeMail());
        });

    }

    // user will have many post and sort according to lastest post
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id')->orderBy('created_at','DESC');
    }

    //user will have mulitple following
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    //user will only have 1 profile
    public function profile()
    {

        return $this->hasOne(Profile::class);
    }
}
