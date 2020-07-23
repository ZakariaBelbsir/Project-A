<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function partner()
    {
        return $this->belongsToMany(Partner::class);
    }
}
