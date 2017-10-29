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
        'avatar', 'email', 'name', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followers()
    {
        return $this
            ->belongsToMany(User::Class, 'followers', 'followed_id', 'user_id');
    }

    public function follows()
    {
        return $this
            ->belongsToMany(User::Class, 'followers', 'user_id', 'followed_id');
    }

    public function isFollowing(User $user)
    {
        return $this
            ->follows->contains($user);
    }

    public function messages()
    {
        return $this
            ->hasMany(Message::Class)
            ->orderBy('created_at', 'desc');
    }

    public function socialProfiles()
    {
        return $this
            ->hasMany(SocialProfile::Class);
    }
}
