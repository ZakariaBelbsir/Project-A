<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city_delivery_time')->insert([
            'delivery_time_id' => 1,
            'city_id' => 1
        ]);
        DB::table('city_delivery_time')->insert([
            'delivery_time_id' => 2,
            'city_id' => 1
        ]);
        DB::table('city_delivery_time')->insert([
            'delivery_time_id' => 3,
            'city_id' => 2
        ]);
        DB::table('city_delivery_time')->insert([
            'delivery_time_id' => 4,
            'city_id' => 2
        ]);
        DB::table('city_delivery_time')->insert([
            'delivery_time_id' => 5,
            'city_id' => 3
        ]);
        DB::table('city_delivery_time')->insert([
            'delivery_time_id' => 6,
            'city_id' => 3
        ]);
        DB::table('city_delivery_time')->insert([
            'delivery_time_id' => 7,
            'city_id' => 3
        ]);
    }
}
