<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //this role model belongs to many users
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
