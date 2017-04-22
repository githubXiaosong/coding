<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetStatus extends Model
{

    protected $table = 'pet_status';

    public function pets()
    {
        return $this->belongsTo('App\Pet');
    }
}
