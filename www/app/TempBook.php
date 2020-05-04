<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempBook extends Model
{
    public function Customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function CartItems(){
        return $this->hasMany(Cart::class, 'temp_book_id');
    }
    //
}
