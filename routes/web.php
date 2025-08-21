<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;


// Route::get('/UserRegistration', );

// customer route

Route::get('/', [CustomerController::class,'index'])->name('index');
Route::match(['get','post'],'/CustomerRegistration', [CustomerController::class,'registration'])->name('customerregistration');
Route::match(['get','post'],'/CustomerLogin', [CustomerController::class,'login'])->name('customerlogin');
Route::get('/CustomerLogout', [CustomerController::class,'logout'])->name('customerlogout');
Route::get('/CustomerDashboard', [CustomerController::class,"dashboard"])->name("customerdashboard");