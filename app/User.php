<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     *
     *
     *
     */


    /*
     *liver对应live   一对一
     */
    public function live()
    {
        return $this->hasOne('App\Live');
    }

    /**
     * tapes对应user  一对多
     */
    public function tapes()
    {
        return $this->hasMany('App\Tape');
    }


    /**
     * 多对多
     */
    public function liveUserWatching()
    {
        return $this->belongsToMany('App\Live','live_user_watching')->withTimestamps();
    }


    public function tapeUserWatched()
    {
        return $this->belongsToMany('App\Tape','tape_user_watched')->withTimestamps();
    }

    public function tapeUserLike()
    {
        return$this->belongsToMany('App\Tape','tape_user_like')->withTimestamps();
    }






}
