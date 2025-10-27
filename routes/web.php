<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShopkeeperController;
use App\Http\Controllers\SubCatagoryController;
use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;


// Admin New Router - done
Route::middleware("adminCheck")->group(function () {

    Route::match(["get", "post"], '/AdminInUser', [AdminController::class, 'CustomerAndShopkeeper_Manage'])->name('admindashboard');
    Route::match(["get", "post"], '/AdminInUserUpdate/{userId}', [AdminController::class, 'CustomerAndShopkeeper_Update'])->name('admindashboard.update');
    Route::match(["get", "post"], '/AdminInProduct', [AdminController::class, 'Product_Manage'])->name('product.manage');
    Route::match(["get", "post"], '/AdminInProductUpdate/{productId}', [AdminController::class, 'Product_Update'])->name('product.Manage.Update');
    Route::match(["get", "post"], '/AdminInOrder', [AdminController::class, 'Order_Manage'])->name('order.Manage');
    Route::match(["get", "post"], '/AdminProfile', [AdminController::class, 'Admin_Profile_Manage'])->name('admin.Profile.Manage');
    Route::match(["get", "post"], '/AdminProductRating', [AdminController::class, 'Admin_Product_Rating'])->name('admin.Product.Rating');


    Route::get('/SearchData/{SearchData}/{TableName}', [AdminController::class, 'Search_Data_Product_User_Order']);
    Route::get('/AdminProductDetail/{productid}', [AdminController::class, 'Admin_Product_Detail']);
    Route::get('/Logout', [AdminController::class, 'Admin_Logout'])->name("admin.Logout");

    // Catagory
    Route::get('/catagorypage', [CatagoryController::class, 'index'])->name("Category.Page");
    Route::get('/catagoryget', [CatagoryController::class, 'catagory_show']);
    Route::post('/catagoryadd', [CatagoryController::class, 'catagory_add']);
    Route::get('/catagoryupdate', [CatagoryController::class, 'catagory_update']);
    Route::delete('/catagorydelete', [CatagoryController::class, 'catagory_delete']);

    // Sub-Catagory
    Route::post('/subcatagoryadd', [SubCatagoryController::class, 'sub_catagory_add']);
    Route::delete('/subcatagorydelete', [SubCatagoryController::class, 'sub_catagory_delete']);
});

// Customer New Router - done
Route::middleware("customerCheck")->group(function () {

    Route::match(["post", "get"], '/customerchangepassword/{customeremail}', [CustomerController::class, "customer_change_password"]);
    Route::match(["post", "get"], '/CustomerProfile', [CustomerController::class, "customer_profile"])->name("Customer.Profile");
    Route::post('/CustomerUpdate', [CustomerController::class, "Customer_Update"]);

    Route::get('/viewprofilecustomer/{email}', [CustomerController::class, "view_profile"]);
    Route::match(['get', 'post'], '/wishlist', [MainController::class, 'wishlist'])->name("wishlist");

    Route::get('/removewishlist/{productid}', [MainController::class, 'remove_wishlist_item']);
    Route::match(["post", "get"], '/order', [MainController::class, 'order_product'])->name('order.Product');

    Route::match(['get', 'post'], '/OrderRating', [RatingController::class, 'Order_Rating_Store'])->name('Order_Rating_Store');
});
Route::get('/logout', [CustomerController::class, 'logout'])->name('customerlogout');


// New Main Route - done
Route::redirect("/", "/MyShop");
Route::get("/Welcome", function () {
    return view("Main.welcome");
});
Route::match(['get', 'post'], '/Registration', [MainController::class, 'Registration'])->name('registration');
Route::match(['get', 'post'], '/Login', [MainController::class, 'Login'])->name('login')->middleware("checksession");
Route::match(["post", "get"], '/ForgetPassword', [MainController::class, "Forget_Password_Email_Find"])->name("forget.Password");
Route::match(["get", "post"], '/ForgetPasswords', [MainController::class, "Forget_Password"])->name("forget.Password.Data");
Route::match(['get', 'post'], "/MyShop", [MainController::class, "Index"])->name("MainIndex");
Route::get('/ProductDetails/{productid}', [MainController::class, 'Product_id_Detail']);
Route::get('/SummryOfProduct', [MainController::class, 'Summry_Product_Detail'])->name("summryproductdetail");
Route::get('/deletecartsummry/{cartid}', [MainController::class, 'delete_cart_summry']);
Route::match(['get', 'post'], '/CheckOut', [MainController::class, 'Checkout_Product'])->name("checkout_product");
Route::post('/search', [MainController::class, 'search_product_name']);
Route::match(['get', 'post'], '/getcategroywiseproduct/{categoryname}', [MainController::class, 'get_category_wise_product']);
Route::get('/discountcoupun/{couponid}/{productid}', [MainController::class, 'discount_coupun']);
Route::get('/removediscount/{productid}', [MainController::class, 'remove_discount_coupun']);
Route::get('/favourite/{productid}', [MainController::class, 'add_to_favourite']);
Route::get('/CartCount', [MainController::class, 'Cart_Count']);
Route::match(['get', 'post'], '/BuyNow/{productId}', [MainController::class, 'Buy_Now_Functionality_Customer']);
Route::match(['get', 'post'], '/BuyNowSummary', [MainController::class, 'Buy_Now_Summary'])->name('buy.Now.Summary');


// Email Check (Ajax)
Route::post('/EmailCheck', [MainController::class, "Login_Email_Check"]);

// State & City Data get
Route::get('/getstate', [CustomerController::class, "getstate"]);
Route::get('/getcity', [CustomerController::class, "getcity"]);
Route::get('/getcountry', [CustomerController::class, "getcountry"]);

Route::get("/welcome", function () {
    return view("Main.welcome");
});



// Shopkeeper New Route
Route::middleware("shopkeeperCheck")->group(function () {

    Route::match(['get', 'post'], '/shopkeeperdashboard', [ShopkeeperController::class, 'dashboard'])->name('shopkeeperdashboard');
    Route::match(["post", "get"], '/shopkeeperchangepassword/{shopkeeperid}', [ShopkeeperController::class, "shopkeeper_change_password"]);
    Route::get('/viewprofile/{email}', [ShopkeeperController::class, "view_profile"]);
    Route::match(['get', 'post'], '/ShopkeeperOrderList', [ShopkeeperController::class, "Shopkeeper_Order_List"])->name("shopkeeper.Order.List");

    Route::get('/RemoveImage/{ImageId}/{ProductId}', [ShopkeeperController::class, "Remove_Image_Product"]);
});
Route::post('/shopkeeperupdate', [ShopkeeperController::class, "updateuser"]);
Route::match(['get', 'post'], '/shopkeeperprofile', [ShopkeeperController::class, "shopkeeper_profile"])->name("Shopkeeper.Profile");


// Error
Route::get('/error', function () {
    return view("Main.error");
})->name('error');


// Product
Route::post('/productadd', [Product_Controller::class, 'product_add_and_update'])->name("product_add_update");
Route::post('/editproduct', [Product_Controller::class, 'product_edit']);
Route::post('/deleteproduct', [Product_Controller::class, 'Product_Delete']);
Route::match(['get', 'post'], '/productaddshop/{category_name}', [Product_Controller::class, 'product_add_show'])->name("product.Add.Show");
Route::get('/ProductDetailsShow/{productid}', [Product_Controller::class, 'product_details']);
Route::match(['get', 'post'], '/productview/{productid}', [Product_Controller::class, 'product_view']);
Route::match(['get', 'post'], '/AddProductPage/{catagoryid}', [Product_Controller::class, 'Add_Product_Page']);




// Add To Cart Functionality
Route::get('/addtocart_desbord/{product_id}', [AddToCartController::class, 'index']);
Route::match(['get', 'post'], '/addtocartget', [AddToCartController::class, 'addtocart_get_all'])->name("addtocart_get_all");
Route::match(['get', 'post'], '/deletetocart', [AddToCartController::class, 'delete_cart'])->name('Delete_AddToCart');
Route::get('/addtocartqueantitychange', [AddToCartController::class, 'update_queantity']);
Route::get('/BuyNowaddtocartqueantitychange', [AddToCartController::class, 'Buy_Now_update_queantity']);
Route::get('/DirectChangeQuentity', [AddToCartController::class, 'direct_change_quentity']);
