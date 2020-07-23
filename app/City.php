<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $guarded = [];
    public function partner()
    {
        return $this->hasOne(Partner::class);
    }

    public function delivery_time()
    {
        return $this->belongsToMany(DeliveryTime::class);
    }
}
