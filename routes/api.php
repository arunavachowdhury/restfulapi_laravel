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
    Route::resource('categories', 'Category\CategoryController');
    Route::resource('products', 'Product\ProductController');
    Route::resource('buyers', 'Buyer\BuyerController');
    Route::resource('seller', 'Seller\SellerController');
    Route::resource('transaction', 'Transaction\TransactionController');