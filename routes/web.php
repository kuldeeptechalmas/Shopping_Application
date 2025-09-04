<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\ShopkeeperController;
use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;


// Route::get('/UserRegistration', );

// Customer Route

Route::redirect("/","/login")->name('welcome');
Route::get("/welcome",function(){
    return view("welcome");
});
Route::match(['get', 'post'], '/registration', [CustomerController::class, 'registration'])->name('customerregistration');
Route::match(['get', 'post'], '/login', [CustomerController::class, 'login'])->name('customerlogin')->middleware("checksession");
Route::get('/logout', [CustomerController::class, 'logout'])->name('customerlogout');
Route::get('/customerdashboard', [CustomerController::class, "dashboard"])->name("customerdashboard")->middleware("customerCheck");
Route::post('/customerupdate', [CustomerController::class, "updateuser"]);
Route::get('/customeruser', [CustomerController::class, "profileuser"]);
Route::get('/getstate', [CustomerController::class, "getstate"]);
Route::get('/getcity', [CustomerController::class, "getcity"]);
Route::get('/getcountry', [CustomerController::class, "getcountry"]);

// Shopkeeper Route
Route::get('/shopkeeperdashboard', [ShopkeeperController::class, 'dashboard'])->name('shopkeeperdashboard')->middleware('shopkeeperCheck');
Route::get('/shopkeeperuser', [ShopkeeperController::class, "profileuser"]);
Route::post('/shopkeeperupdate', [ShopkeeperController::class, "updateuser"]);


// Admin Route
Route::get('/admindashboard', [AdminController::class, 'dashboard'])->name('admindashboard')->middleware('adminCheck');
Route::get('/adminlogout', [AdminController::class, 'logout'])->name('adminlogout');
Route::get('/adminruser', [AdminController::class, "profileuser"]);
Route::post('/adminupdate', [AdminController::class, "updateuser"]);
Route::get('/deleterecord', [AdminController::class, "deleterecord"]);
Route::get('/getuserofall', [AdminController::class, "getuserofall"]);
Route::post('/adminviewupdate', [AdminController::class, "viewupdateuser"]);

// Error
Route::get('/error', function(){
    return view('error');
})->name('error');


// Product
Route::post('/productadd', [Product_Controller::class,'product_add']);
Route::get('/getproductall', [Product_Controller::class,'product_get_all']);
Route::post('/editproduct', [Product_Controller::class,'product_edit']);
Route::delete('/deleteproduct', [Product_Controller::class,'product_remove']);
Route::get('/searchproduct', [Product_Controller::class,'product_search']);
Route::get('/getproductshopkeeper', [Product_Controller::class,'product_list_get_shopkeeper']);
Route::get('/productaddshop/{category_name}', [Product_Controller::class,'product_add_show']);
