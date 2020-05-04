<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function FoodType(){
        return $this->belongsTo(FoodType::class, 'food_type_id');
    }
    //
}
