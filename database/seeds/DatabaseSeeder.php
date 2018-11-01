<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        \App\User::truncate();
        \App\Category::truncate();
        \App\Product::truncate();
        \App\Transaction::truncate();

        factory(\App\User::class,100)->create();
        factory(\App\Category::class,10)->create();
        factory(\App\Product::class,30)->create()->each(
            function ($product) {
                $categories = \App\Category::all()->random(mt_rand(1, 5))->pluck('id');
                $product->categories()->attach($categories);
            }
        );
        factory(\App\Transaction::class,10)->create();

    }
}
