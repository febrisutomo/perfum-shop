<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Febri Sutomo',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Alex Murphy',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('123'),
        ]);

        Brand::factory(5)->create();

        Category::create([
            'name' => 'For Men',
            'slug' => 'for-men',
        ]);
        Category::create([
            'name' => 'For Women',
            'slug' => 'for-women',
        ]);
        Category::create([
            'name' => 'For Unisex',
            'slug' => 'for-unisex',
        ]);

        Item::factory(20)->create();

        
        // Category::factory(10)->create();

        // Item::all()->each(function ($item) {
        //     $item->categories()->attach(
        //         Category::all()->random(rand(1, 3))->pluck('id')->toArray()
        //     );
        // });

        // Order::factory(10)->create();

        // Order::all()->each(function ($order) {
        //     $items = [];
        //     $i = 1;
        //     while ( $i <= rand(1, 5)) {
        //         $item = Item::all()->random();
        //         $items[$item->id] = [
        //             'price' => $item->price,
        //             'qty' => Faker::create()->numberBetween(1, 20)
        //         ];
        //         $i++;
        //     }
        //     $order->items()->attach($items);
        // });
    }
}
