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
    Route::resource('categories', 'Category\CategoryController',['only'=> ['index','store','update']]);


    Route::resource('products', 'Product\ProductController',['only'=> ['index','show']]);
    Route::resource('products.categories', 'Product\ProductCategoryController', ['only' => ['index','update','destroy']]);
    Route::resource('products.buyer', 'Product\ProductBuyerController', ['only' => ['index']]);
    Route::resource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);

    Route::resource('buyers', 'Buyer\BuyerController', ['only'=> ['index','show']]);
    Route::resource('buyers.transactions', 'Buyer\BuyerTransactionController', ['only' =>['index']]);
    Route::resource('buyers.products', 'Buyer\BuyerProductController', ['only'=> ['index']]);
    Route::resource('buyers.seller', 'Buyer\BuyerSellerController', ['only'=> ['index']]);
    Route::resource('buyers.categories', 'Buyer\BuyerCategoryController', ['only'=> ['index']]);



    Route::resource('seller', 'Seller\SellerController');
    Route::resource('transaction', 'Transaction\TransactionController');