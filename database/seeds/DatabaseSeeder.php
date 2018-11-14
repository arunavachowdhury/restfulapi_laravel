<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\Transaction;
use App\User;

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
        
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();

        User::flashEventListeners();
        Category::flashEventListeners();
        Product::flashEventListeners();
        Transaction::flashEventListeners();

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
