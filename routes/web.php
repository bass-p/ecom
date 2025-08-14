<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\OrderManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsManager;

// static routes 
Route::get('/', action: [ProductsManager::class, "index"])->name('home');

Route::get('/about', function () {
    return view('static/about');
})->name('about');

Route::get('/contact', function () {
    return view('static/contact');
})->name('contact');

Route::get('/privacy-policy', function () {
    return view('static/privacy-policy');
})->name('privacy-policy');
//static routes end


Route::get("login", [AuthManager::class,"login"])->name("login");

Route::get("logout", [AuthManager::class,"logout"])->name("logout");

Route::post("login", [AuthManager::class, "loginPost"])->name("login.post");

Route::get("register", [AuthManager::class, "register"])->name("register");

Route::post("register", [AuthManager::class,"registerPost"])->name("register.post");

Route::get("/product/{slug}", [ProductsManager::class,"details"])->name("products.details");


Route::middleware(["auth"])->group(function () {
    Route::get("/card/{id}", [ProductsManager::class,"addToCart"])->name("cart.add");

    Route::get("/cart", [ProductsManager::class,"showCart"])->name("cart.show");

    //Route::delete('/cart/remove/{id}', action: [ProductsManager::class, 'removeCart'])->name('cart.remove');

    Route::get("/checkout", [OrderManager::class,"showCheckout"])->name("checkout.show");

    Route::post("/checkout", [OrderManager::class,"checkoutPost"])->name("checkout.post");

});
