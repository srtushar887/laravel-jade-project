<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service_request extends Model
{
    public function tantan()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function property()
    {
        return $this->hasOne(property::class,'id','property_id');
    }
}
