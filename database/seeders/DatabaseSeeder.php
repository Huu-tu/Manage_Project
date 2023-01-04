<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
//        Product::factory()->times(30)->create();
        Order::factory()->times(30)->create();
        // \App\Models\User::factory(10)->create();
    }
}
