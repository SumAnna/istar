<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function numbers()
    {
        return $this->hasMany('App\Number');
    }
}
