<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    public function TradeMark(){
        return $this->belongsTo(TradeMark::class, 'trade_mark_id');
    }
    //
}
