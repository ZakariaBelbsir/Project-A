<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
