<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_times')->insert([
            'delivery_at' => '9-12',
        ]);
        DB::table('delivery_times')->insert([
            'delivery_at' => '14-18',
        ]);
        DB::table('delivery_times')->insert([
            'delivery_at' => '10-13',
        ]);
        DB::table('delivery_times')->insert([
            'delivery_at' => '15-19',
        ]);
        DB::table('delivery_times')->insert([
            'delivery_at' => '9-13',
        ]);
        DB::table('delivery_times')->insert([
            'delivery_at' => '14-18',
        ]);
        DB::table('delivery_times')->insert([
            'delivery_at' => '18-20',
        ]);
    }
}
