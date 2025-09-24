<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\ShopkeeperController;
use App\Http\Controllers\SubCatagoryController;
use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;


// Main page Route
Route::redirect("/","/MyShop");
Route::get("/MyShop",[MainController::class,"index"])->name("MainIndex");
Route::get("/mainproductget",[MainController::class,"main_product_get_all"]);
Route::get('/productdetailsunkown/{productid}', [MainController::class,'product_details']);
Route::get('/checkouttoconform', [MainController::class,'checkout_page']);
Route::post('/search', [MainController::class,'search_product_name']);
Route::get('/getcategroywiseproduct/{categoryname}', [MainController::class,'get_category_wise_product']);
Route::get('/favourite/{productid}', [MainController::class,'add_to_favourite']);
Route::get('/wishlist', [MainController::class,'wishlist'])->name("wishlist");
Route::get('/removewishlist/{productid}', [MainController::class,'remove_wishlist_item']);
Route::post('/searchwishlist', [MainController::class,'search_wishlist_item']);
Route::get('/discountcoupun/{couponid}/{productid}', [MainController::class,'discount_coupun']);
Route::get('/removediscount/{productid}', [MainController::class,'remove_discount_coupun']);

// Checkout Functionality
Route::get('/checkout', [MainController::class,'checkout_product'])->name("checkout_product");
Route::get('/summryproductdetail', [MainController::class,'summry_product_detail'])->name("summryproductdetail");
Route::get('/deletecartsummry/{cartid}', [MainController::class,'delete_cart_summry']);

// Order Functionality
Route::match(["post","get"],'/order', [MainController::class,'order_product']);
Route::get('/deleteorder/{orderid}', [MainController::class,'order_delete']);

// Customer Route
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
Route::get('/customerprofile/{customeremail}', [CustomerController::class, "customer_profile"]);
Route::match(["post","get"],'/customerchangepassword/{customeremail}', [CustomerController::class, "customer_change_password"]);

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
Route::get('/admingetuserofall', [AdminController::class, "admin_getuserofall"])->name("admin_get_user_of_all");
Route::post('/adminviewupdate', [AdminController::class, "viewupdateuser"]);
Route::get('/productdetailsadmin/{productid}', [AdminController::class,'product_details']);
Route::get('/viewallorder', [AdminController::class,'view_all_order']);
Route::get('/vieworder/{orderid}', [AdminController::class,'view_order']);

// Error
Route::get('/error', function(){
    return view('error');
})->name('error');


// Product
Route::post('/productadd', [Product_Controller::class,'product_add']);
Route::get('/getproductall', [Product_Controller::class,'product_get_all']);
Route::get('/admingetproductall', [Product_Controller::class,'Admin_product_get_all']);
Route::post('/editproduct', [Product_Controller::class,'product_edit']);
Route::delete('/deleteproduct', [Product_Controller::class,'product_remove']);
Route::get('/searchproduct', [Product_Controller::class,'product_search']);
Route::get('/getproductshopkeeper', [Product_Controller::class,'product_list_get_shopkeeper']);
Route::get('/productaddshop/{category_name}', [Product_Controller::class,'product_add_show']);
Route::get('/productdetails/{productid}', [Product_Controller::class,'product_details']);
Route::get('/productview/{productid}', [Product_Controller::class,'product_view']);
Route::get('/productviewadmin/{productid}', [Product_Controller::class,'product_view_admin']);


// Catagory
Route::get('/catagorypage', [CatagoryController::class,'index']);
Route::get('/catagoryget', [CatagoryController::class,'catagory_show']);
Route::post('/catagoryadd', [CatagoryController::class,'catagory_add']);
Route::get('/catagoryupdate', [CatagoryController::class,'catagory_update']);
Route::delete('/catagorydelete', [CatagoryController::class,'catagory_delete']);

// Sub-Catagory
Route::post('/subcatagoryadd', [SubCatagoryController::class,'sub_catagory_add']);
Route::delete('/subcatagorydelete', [SubCatagoryController::class,'sub_catagory_delete']);

// Add To Cart Functionality
Route::get('/addtocart_desbord/{product_id}', [AddToCartController::class,'index']);
Route::get('/addtocartget', [AddToCartController::class,'addtocart_get_all'])->name("addtocart_get_all");
Route::get('/deletetocart/{cartid}', [AddToCartController::class,'delete_cart']);
Route::get('/addtocartqueantitychange', [AddToCartController::class,'update_queantity']);

