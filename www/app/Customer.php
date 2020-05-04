<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function UgraiBook(){
        return $this->hasMany(UgraiBook::class, 'customer_id');
    }
    public function TempBook(){
        return $this->hasMany(TempBook::class, 'customer_id');
    }
    //
}
