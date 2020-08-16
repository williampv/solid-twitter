<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    public  function likes() {
        return $this->hasMany(Like::class);
    }
}
