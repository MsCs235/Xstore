<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReturnorderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;




Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//  start dashboard

Route::get('/Overview' , [HomeController::class,'overview'])->name('over');

Route::get('/orders', function () {
    return view('layouts.orders');
})->name('userorders');


Route::get('/products', function () {
    return view('layouts.products');
})->name('userproducts');

Route::get('/returns' , [ReturnorderController::class,'index'])->name('userreturns');

Route::get('/profile', function () {
    return view('layouts.profile');
})->name('userprofile');


Route::get('/message', function () {
    return view('layouts.message');
})->name('usermessage');

Route::get('/Addproduct', function () {
    return view('layouts.createproduct');
})->name('createproduct');
// end dashboard

// add product process
Route::post('/save-product' , [ProductController::class,'store'])->name('upload.product');
//delete product process
Route::get('/delete-product/{id}' , [ProductController::class,'destroy'])->name('delete.product');
//edite product process
Route::get('/update-product/{id}' , [ProductController::class,'show'])->name('display.product');
Route::post('/update-product/{id}' , [ProductController::class,'update'])->name('update.product');

// return product to view
Route::get('/product' , [ProductController::class,'index'])->name('userproducts');


//edite profile 
Route::post('/update-profile' , [UserController::class,'update'])->name('update.profile');
//change password
Route::post('/ChangePassword' , [UserController::class,'edit'])->name('edit.password');

//product page
Route::get('/product/{product}' , [ProductController::class,'view'])->name('view.product');

// cart page
Route::get('/shopingcart', function () {
    return view('layouts.shopingcart');
})->name('shopingcart');

Route::get('/cart-view' , [CartController::class,'index'])->name('view.cart');


// Add to cart
Route::post('/AddProduct-cart/{id}' , [CartController::class,'store'])->name('add.product');
//delete cart
Route::get('/DeleteProduct-cart/{id}' , [CartController::class,'destroy'])->name('delete.cart');

//confirm order
Route::get('/make-order' , [OrderController::class,'store'])->name('make.order');

//dashboard order view
Route::get('/order' , [OrderController::class,'index'])->name('order.view');

//search result view
Route::get('/Search-view' , [ProductController::class,'search'])->name('search.view');

//categories
Route::get('/Search-view/{value}' , [ProductController::class,'filter'])->name('filter.view');

//write review
Route::post('/Submit-review/{id}' , [ReviewController::class,'store'])->name('review.submit');


//---------------------------------------------------------------------------------------------------
// return product to dashboard
Route::get('/auction' , [AuctionController::class,'index'])->name('userauctions'); //done

//Auction page view
Route::get('/auction/{product}' , [AuctionController::class,'view'])->name('view.auction'); //done

// add auction process
Route::get('/Addauction', function () {
    return view('layouts.createauction');
})->name('createauction'); //done

Route::post('/save-auction' , [AuctionController::class,'store'])->name('upload.auction'); //done

//delete auction process
Route::get('/delete-auction/{id}' , [AuctionController::class,'destroy'])->name('delete.auction'); //done

//edite auction process
Route::get('/update-auction/{id}' , [AuctionController::class,'show'])->name('display.auction');
Route::post('/update-auction/{id}' , [AuctionController::class,'update'])->name('update.auction'); //done

// add bid
Route::post('/Addbid/{id}' , [AuctionController::class,'create'])->name('add.bid');

// cancel order
Route::get('/Cancel-order/{id}' , [OrderController::class,'cancel'])->name('cancel.order');

// seller confirm order
Route::get('/Confirm-order/{id}' , [OrderController::class,'confirm'])->name('confirm.order');

// return order request
Route::post('/Request-return-order/{id}' , [OrderController::class,'return'])->name('return.order');

// confirm order request
Route::post('/Confirm-return-order/{id}' , [ReturnorderController::class,'create'])->name('confirmreturn.order');

// close auction details view
Route::get('/close-auctoin-view/{id}' , [AuctionController::class,'closeAuctionView'])->name('auction.details');