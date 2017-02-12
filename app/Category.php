<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function lives()
    {
        return $this->hasMany('App\Live');
    }

}
