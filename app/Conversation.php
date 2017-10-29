<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public static function between(User $user, User $other)
    {
        //* Check if exists a conversation bewtween two users
        $query = Conversation::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereHas('users', function ($query) use ($other) {
            $query->where('user_id', $other->id);
        });

        //* If exists a conversation with these attributes, return conversation, else create it
        $conversation = $query->firstOrCreate([]);

        //* Synchronize users with the conversation: if no users in the conversation, attach them, else, continue
        $conversation->users()-> sync([
            $user->id, $other->id
        ]);

        return $conversation;
    }

    public function privateMessages()
    {
        return $this
            ->hasMany(PrivateMessage::class)
            ->orderBy('created_at');
    }

    public function users()
    {
        return $this
            ->belongsToMany(User::class);
    }
}
