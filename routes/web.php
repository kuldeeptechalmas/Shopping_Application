<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShopkeeperController;
use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;


// Route::get('/UserRegistration', );

// Customer Route

Route::get('/', function () {
    return view("welcome");
})->name('welcome');

Route::match(['get', 'post'], '/registration', [CustomerController::class, 'registration'])->name('customerregistration');
Route::match(['get', 'post'], '/login', [CustomerController::class, 'login'])->name('customerlogin')->middleware("checksession");
Route::get('/logout', [CustomerController::class, 'logout'])->name('customerlogout');
Route::get('/customerdashboard', [CustomerController::class, "dashboard"])->name("customerdashboard")->middleware("customerCheck");


// Shopkeeper Route
Route::get('/shopkeeperdashboard', [ShopkeeperController::class, 'dashboard'])->name('shopkeeperdashboard');


// Admin Route
Route::get('/admindashboard', [AdminController::class, 'dashboard'])->name('admindashboard')->middleware('adminCheck');
Route::match(['get', 'post'], '/admin', [AdminController::class, "login"])->name("adminlogin");
Route::get('/adminlogout', [AdminController::class, 'logout'])->name('adminlogout');