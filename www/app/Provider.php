<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public function TradeMark(){
        return $this->hasOne(TradeMark::class, 'provider_id');
    }
    //


}
