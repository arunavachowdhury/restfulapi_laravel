<?php

use Faker\Generator as Faker;
use App\User;
use App\Category;
use App\Product;
use App\Transaction;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        
        'varified' => $varified = $faker->randomElement([User::VARIFIED_USER,User::UNVARIFIED_USER]),
        'varification_token' => $varified == User::VARIFIED_USER ? null : User::generateVerificationToken(),
        'admin' => $faker->randomElement([User::ADMIN_USER,User::REGULER_USER])
    ];
});

$factory->define(\App\Category::class,function (faker $faker){
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1)
    ];
});

$factory->define(\App\Product::class,function (faker $faker){
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1,10),
        'status' => $faker->randomElement([Product::AVALIABLE_PRODUCT,Product::UNAVALIABLE_PRODUCT]),
        'image' => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'seller_id' => User::all()->random()->id
    ];
});

$factory->define(\App\Transaction::class,function(Faker $faker){
    $seller = \App\Seller::has('products')->get()->random();
    $buyer = User::all()->except($seller->id)->random();
    
    return[
        'quantity' => $faker->numberBetween(1,5),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id
    ];
});