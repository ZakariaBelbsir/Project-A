<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'flowers',
            'picture' => '/images/flowers.jpg'
        ]);
        DB::table('products')->insert([
            'name' => 'perfumes',
            'picture' => '/images/perfume.jpg'
        ]);
        DB::table('products')->insert([
            'name' => 'chocolate',
            'picture' => '/images/chocolate.jpg'
        ]);
    }
}
