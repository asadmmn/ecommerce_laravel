<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed users
        User::factory(10)->create();

        // Seed categories
        Category::factory(5)->create();

        // Seed products
        Product::factory(20)->create();

        // Seed carts
        Cart::factory(30)->create();

        // Seed orders
        //Order::factory(15)->create();

        // Seed order items
        //OrderItem::factory(50)->create();
    }
}
