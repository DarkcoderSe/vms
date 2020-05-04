<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnerTransaction extends Model
{
    //
    protected $table="owner_transactions";
    protected $fillable = [
        "owner_id", "expenses", "description",
    ];

    public function owner(){
        return $this->belongsTo(Owners::class);
    }
}
