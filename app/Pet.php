<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';

    public function petStatus()
    {
        return $this->hasMany('App\PetStatus');
    }
}
