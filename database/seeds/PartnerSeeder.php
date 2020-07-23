<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->insert([
            'name' => 'Mohamed',
            'city_id' => 1
        ]);
        DB::table('partners')->insert([
            'name' => 'Hassan',
            'city_id' => 2
        ]);
        DB::table('partners')->insert([
            'name' => 'Nada',
            'city_id' => 3
        ]);
    }
}
