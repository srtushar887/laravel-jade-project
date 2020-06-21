<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assign_property extends Model
{
    public function tanant()
    {
        return $this->hasOne(User::class,'id','tanants_id');
    }

    public function property()
    {
        return $this->hasOne(property::class,'id','property_id');
    }
}
