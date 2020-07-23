<?php

namespace App\Http\Controllers;

use App\DeliveryTime;
use Illuminate\Http\Request;

class DeliveryTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'deliveryTimes' => DeliveryTime::all()
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'delivery_at' => 'required'
        ]);
        DeliveryTime::create($attributes);
        return response()->json([
            'message' => 'Delivery time added successfully'
        ]);
    }


}
