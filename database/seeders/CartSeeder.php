<?php
namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;
use App\Models\Cart;

class CartSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Cart::create([
                'user_id' => $faker->numberBetween(1, 10), // Assuming users already exist
                'product_id' => $faker->numberBetween(1, 20), // Assuming products already exist
                'quantity' => $faker->numberBetween(1, 5),
                'price' => $faker->randomFloat(2, 10, 100),
            ]);
        }
    }
}
