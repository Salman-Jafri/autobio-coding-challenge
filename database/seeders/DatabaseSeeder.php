<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Item;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Customer::factory(10000)->create()->each(function ($customer) {
            $orders = Order::factory(rand(1, 3))->create(['customer_id' => $customer->id]);

            $orders->each(function ($order) {
                Item::factory(rand(1, 5))->create(['order_id' => $order->id]);
            });
        });
    }
}
