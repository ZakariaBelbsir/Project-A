<?php

namespace App\Http\Controllers;

use App\City;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($city_id)
    {
        $city = City::find($city_id);
        return response()->json([
            'products' => $city->partner->product
        ]);
    }
}
