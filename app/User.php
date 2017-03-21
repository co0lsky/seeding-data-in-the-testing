<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function follows(User $user)
    {
        $this->following()->attach($user->id);
    }

    public function unfollows(User $user)
    {
        $this->following()->detach($user->id);
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'following', 'user_id', 'follow_user_id')->withTimestamps();
    }

    public function isFollowing(User $user)
    {
        return !is_null($this->following()->where('follow_user_id', $user->id)->first());
    }
}
