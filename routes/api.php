<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'auth.jwt'], function(){
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group(['middleware' => 'auth.jwt'], function(){
    Route::group(['middleware' => 'App\Http\Middleware\CheckIsAdmin'], function(){
        Route::post('/cities', 'CityController@store');
        Route::post('/delivery-times', 'DeliveryTimeController@store');
        Route::get('/delivery-times', 'DeliveryTimeController@index');
        Route::post('/cities/{city_id}/delivery-times', 'CityDeliveryController@store');
        Route::post('/cities/{city}/exclude', 'CityDeliveryController@exclude');
    });
    Route::get('/{city_id}/products', 'ProductController@index');
    Route::get('/cities/{city}/delivery-times', 'CityDeliveryController@show');
    Route::get('/cities', 'CityController@index');

    Route::post('/cities/{city}/delivery-dates-times', 'CityDeliveryController@getExcludedTimes');
});

Route::get('/cities/{city_id}/delivery-dates-times/{number_of_days}', 'CityDeliveryController@getDeliverySpan');



