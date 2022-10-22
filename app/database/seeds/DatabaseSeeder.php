<?php

use Illuminate\Database\Seeder;
use App\Customer;
use App\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CustomersTableSeeder::class);
        // $this->call(ItemsTableSeeder::class);
        // $this->call(OrdersTableSeeder::class);

        // 中間テーブル用
        $items = \App\Item::all();
        
        factory(Order::class, 1000)->create()
                            ->each(function(Order $order) use ($items) {
                                $order
                                ->items()
                                ->attach(
                                    $items->random(rand(1,1))->pluck('id')->toArray()
                                );
                            });
    }
}
