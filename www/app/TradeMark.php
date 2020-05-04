<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeMark extends Model
{
    public function FoodTypes(){
        return $this->hasMany(FoodType::class, 'trade_mark_id');
    }
    public function Provider(){
        return $this->belongsTo(Provider::class, 'provider_id');
    }
    //
}
