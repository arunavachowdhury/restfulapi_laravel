<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
    Route::resource('users', 'User\UserController');

    Route::resource('categories', 'Category\CategoryController',['only'=> ['index','show','store','update']]);
    Route::resource('categories.buyer','Category\CategoryBuyerController', ['only' => ['index']]);
    Route::resource('categories.transactions', 'Category\CategoryTransactionController', ['only' => ['index']]);
    Route::resource('categories.products', 'Category\CategoryProductController' , ['only' => ['index']]);
    Route::resource('categories.seller', 'Category\CategorySellerController' , ['only' => ['index']]);

    Route::resource('products', 'Product\ProductController',['only'=> ['index','show']]);
    Route::resource('products.categories', 'Product\ProductCategoryController', ['only' => ['index','update','destroy']]);
    Route::resource('products.buyer', 'Product\ProductBuyerController', ['only' => ['index']]);
    Route::resource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);

    Route::resource('buyers', 'Buyer\BuyerController', ['only'=> ['index','show']]);
    Route::resource('buyers.transactions', 'Buyer\BuyerTransactionController', ['only' =>['index']]);
    Route::resource('buyers.products', 'Buyer\BuyerProductController', ['only'=> ['index']]);
    Route::resource('buyers.seller', 'Buyer\BuyerSellerController', ['only'=> ['index']]);
    Route::resource('buyers.categories', 'Buyer\BuyerCategoryController', ['only'=> ['index']]);
    Route::resource('buyers.products.transactions', 'Buyer\BuyerProductTransactionController',['only'=> ['store']]);


    Route::resource('seller', 'Seller\SellerController', ['only' => ['index','show']]);
    Route::resource('seller.products', 'Seller\SellerProductController', ['only' => ['index','store','update','destroy']]);
    Route::resource('seller.transactions', 'Seller\SellerTransactionController' , ['only' => ['index']]);
    Route::resource('seller.buyer', 'Seller\SellerBuyerController' , ['only' => ['index']]);
    Route::resource('seller.categories', 'Seller\SellerCategoryController', ['only'=> ['index']]);

    Route::resource('transactions', 'Transaction\TransactionController',['only' => ['index','show']]);
    Route::resource('transactions.buyer','Transaction\TransactionBuyerController',['only'=> ['index']]);
    Route::resource('transactions.seller', 'Transaction\TransactionSellerController', ['only'=> ['index']]);

    Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
    Route::name('resend')->get('users/{user}/resend', 'User\UserController@resend');