<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deposit extends Model
{
    public function user()
    {
        return $this->hasOne(User::class,'id','tanant_id');
    }
}
