<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function comment()
    {
        return $this->belongsTo('App\User');
    }

    public function content()
    {
        return $this->belongsTo('App\Comment');
    }
}
