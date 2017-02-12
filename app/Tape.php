<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tape extends Model
{


    /**
     * user对应tape 一对多
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * 多对多
     */
    public function tapeUserWatched()
    {
        return $this->belongsToMany('App\User','tape_user_watched')->withTimestamps();
    }

    public function tapeUserLike()
    {
        return $this->belongsToMany('App\User','tape_user_like')->withTimestamps();
    }

}
