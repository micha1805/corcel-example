<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = null;

    public function user()
    {
        return $this
            ->belongsTo(User::Class);
    }

    public function message()
    {
        return $this
            ->belongsTo(Message::Class);
    }
}
