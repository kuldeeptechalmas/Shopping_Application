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


// Admin New Router - done
Route::middleware("adminCheck")->group(function () {

    Route::match(["get", "post"], '/AdminInUser', [AdminController::class, 'CustomerAndShopkeeper_Manage'])->name('admindashboard');
    Route::match(["get", "post"], '/AdminInProduct', [AdminController::class, 'Product_Manage'])->name('product.manage');
    Route::match(["get", "post"], '/AdminInOrder', [AdminController::class, 'Order_Manage'])->name('order.Manage');
    Route::match(["get", "post"], '/AdminProfile', [AdminController::class, 'Admin_Profile_Manage'])->name('admin.Profile.Manage');

    Route::get('/AdminProductDetail/{productid}', [AdminController::class, 'Admin_Product_Detail']);
    Route::get('/Logout', [AdminController::class, 'Admin_Logout'])->name("admin.Logout");
});

// Customer New Router - done
Route::middleware("customerCheck")->group(function () {

    Route::match(["post", "get"], '/customerchangepassword/{customeremail}', [CustomerController::class, "customer_change_password"]);
    Route::get('/customerprofile/{customeremail}', [CustomerController::class, "customer_profile"]);
    Route::get('/viewprofilecustomer/{email}', [CustomerController::class, "view_profile"]);
    Route::get('/logout', [CustomerController::class, 'logout'])->name('customerlogout');
    Route::get('/wishlist', [MainController::class, 'wishlist'])->name("wishlist");
    Route::get('/removewishlist/{productid}', [MainController::class, 'remove_wishlist_item']);
    Route::post('/searchwishlist', [MainController::class, 'search_wishlist_item']);
    Route::match(["post", "get"], '/order', [MainController::class, 'order_product']);
    Route::get('/deleteorder/{orderid}', [MainController::class, 'order_delete']);
});


// New Main Route - done
Route::redirect("/", "/MyShop");
Route::get("/Welcome", function () {
    return view("Main.welcome");
});
Route::match(['get', 'post'], '/Registration', [MainController::class, 'Registration'])->name('registration');
Route::match(['get', 'post'], '/Login', [MainController::class, 'Login'])->name('login')->middleware("checksession");
Route::match(["post", "get"], '/ForgetPassword', [MainController::class, "Forget_Password_Email_Find"])->name("forget.Password");
Route::match(["get", "post"], '/ForgetPasswords', [MainController::class, "Forget_Password"])->name("forget.Password.Data");
Route::get("/MyShop", [MainController::class, "Index"])->name("MainIndex");
Route::get('/ProductDetails/{productid}', [MainController::class, 'Product_id_Detail']);
Route::get('/SummryOfProduct', [MainController::class, 'Summry_Product_Detail'])->name("summryproductdetail");
Route::get('/deletecartsummry/{cartid}', [MainController::class, 'delete_cart_summry']);
Route::get('/CheckOut', [MainController::class, 'Checkout_Product'])->name("checkout_product");
Route::post('/search', [MainController::class, 'search_product_name']);
Route::get('/getcategroywiseproduct/{categoryname}', [MainController::class, 'get_category_wise_product']);
Route::get('/discountcoupun/{couponid}/{productid}', [MainController::class, 'discount_coupun']);
Route::get('/removediscount/{productid}', [MainController::class, 'remove_discount_coupun']);
Route::get('/favourite/{productid}', [MainController::class, 'add_to_favourite']);

// State & City Data get
Route::get('/getstate', [CustomerController::class, "getstate"]);
Route::get('/getcity', [CustomerController::class, "getcity"]);
Route::get('/getcountry', [CustomerController::class, "getcountry"]);

Route::get("/welcome", function () {
    return view("Main.welcome");
});


// Shopkeeper New Route
Route::middleware("shopkeeperCheck")->group(function () {

    Route::get('/shopkeeperdashboard', [ShopkeeperController::class, 'dashboard'])->name('shopkeeperdashboard');
    Route::get('/shopkeeperuser', [ShopkeeperController::class, "profileuser"]);
    Route::match(["post", "get"], '/shopkeeperchangepassword/{shopkeeperid}', [ShopkeeperController::class, "shopkeeper_change_password"]);
    Route::get('/viewprofile/{email}', [ShopkeeperController::class, "view_profile"]);
    Route::match(['get', 'post'], '/ShopkeeperOrderList', [ShopkeeperController::class, "Shopkeeper_Order_List"])->name("shopkeeper.Order.List");
});
Route::post('/shopkeeperupdate', [ShopkeeperController::class, "updateuser"]);
Route::get('/shopkeeperprofile/{shopkeeperid}', [ShopkeeperController::class, "shopkeeper_profile"]);


// Error
Route::get('/error', function () {
    return view("Main.error");
})->name('error');


// Product
Route::post('/productadd', [Product_Controller::class, 'product_add_and_update'])->name("product_add_update");
Route::get('/getproductall', [Product_Controller::class, 'product_get_all']);
Route::post('/editproduct', [Product_Controller::class, 'product_edit']);
Route::post('/deleteproductadmin', [Product_Controller::class, 'admin_product_remove'])->name("delete_product_admin");
Route::post('/deleteproduct', [Product_Controller::class, 'Product_Delete']);
Route::get('/searchproduct', [Product_Controller::class, 'product_search']);
Route::get('/getproductshopkeeper', [Product_Controller::class, 'product_list_get_shopkeeper']);
Route::get('/productaddshop/{category_name}', [Product_Controller::class, 'product_add_show']);
Route::get('/productdetails/{productid}', [Product_Controller::class, 'product_details']);
Route::match(['get', 'post'], '/productview/{productid}', [Product_Controller::class, 'product_view']);
Route::match(['get', 'post'], '/AddProductPage/{catagoryid}', [Product_Controller::class, 'Add_Product_Page']);


// Catagory
Route::get('/catagorypage', [CatagoryController::class, 'index']);
Route::get('/catagoryget', [CatagoryController::class, 'catagory_show']);
Route::post('/catagoryadd', [CatagoryController::class, 'catagory_add']);
Route::get('/catagoryupdate', [CatagoryController::class, 'catagory_update']);
Route::delete('/catagorydelete', [CatagoryController::class, 'catagory_delete']);

// Sub-Catagory
Route::post('/subcatagoryadd', [SubCatagoryController::class, 'sub_catagory_add']);
Route::delete('/subcatagorydelete', [SubCatagoryController::class, 'sub_catagory_delete']);

// Add To Cart Functionality
Route::get('/addtocart_desbord/{product_id}', [AddToCartController::class, 'index']);
Route::get('/addtocartget', [AddToCartController::class, 'addtocart_get_all'])->name("addtocart_get_all");
Route::get('/deletetocart/{cartid}', [AddToCartController::class, 'delete_cart']);
Route::get('/addtocartqueantitychange', [AddToCartController::class, 'update_queantity']);
