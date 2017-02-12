<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{

    /*
       *user对应live   一对一
       */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * 多对多
     */
    public function liveUserWatching()
    {
        return $this->belongsToMany('App\User','live_user_watching')->withTimestamps();
    }


    public function category()
    {
        return $this->belongsTo('App\Category');
    }


}
