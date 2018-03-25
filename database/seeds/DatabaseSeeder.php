<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(GoodsTableSeeder::class);
		 $this->call(GoodsGroupTableSeeder::class);
		 //$this->call(ListingTableSeeder::class);
    }
}
