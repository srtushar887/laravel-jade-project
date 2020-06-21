<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_lease_propety extends Model
{
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function property()
    {
        return $this->hasOne(property::class,'id','property_id');
    }
}
