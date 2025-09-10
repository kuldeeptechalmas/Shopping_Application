<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\ShopkeeperController;
use App\Http\Controllers\SubCatagoryController;
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
Route::get('/shopkeeperprofile/{shopkeeperid}', [ShopkeeperController::class, "shopkeeper_profile"]);
Route::match(["post","get"],'/shopkeeperchangepassword/{shopkeeperid}', [ShopkeeperController::class, "shopkeeper_change_password"]);
Route::match(["get","post"],'/forgetpasswords', [ShopkeeperController::class, "shopkeeper_forget_password"])->name("forgetpassword");
Route::get('/viewprofile/{email}', [ShopkeeperController::class, "view_profile"]);

// forgetpassword user
Route::match(["post","get"],'/forgetpassword', [ShopkeeperController::class, "forget_password"]);


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
Route::get('/productdetails/{productid}', [Product_Controller::class,'product_details']);
Route::get('/productview/{productid}', [Product_Controller::class,'product_view']);


// Catagory
Route::get('/catagorypage', [CatagoryController::class,'index']);
Route::get('/catagoryget', [CatagoryController::class,'catagory_show']);
Route::post('/catagoryadd', [CatagoryController::class,'catagory_add']);
Route::get('/catagoryupdate', [CatagoryController::class,'catagory_update']);
Route::delete('/catagorydelete', [CatagoryController::class,'catagory_delete']);

// Sub-Catagory
Route::post('/subcatagoryadd', [SubCatagoryController::class,'sub_catagory_add']);
Route::delete('/subcatagorydelete', [SubCatagoryController::class,'sub_catagory_delete']);

