<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Admin;
use App\Models\CategoryProduct;
use App\Models\Coupen;
use App\Models\CustomerAndShopkeeper;
use App\Models\CustomerOrder;
use App\Models\FavouriceProduct;
use App\Models\Product;
use App\Models\UserCoupunData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password as RulesPassword;

class MainController extends Controller
{

    // Login
    public function Login(Request $request)
    {

        if ($request->isMethod("post")) {

            $validator = $request->validate(
                [
                    "email" => "required",
                    "password" => "required",
                ],
                [
                    "email.required" => "Enter Email is Required.",
                    "password.required" => "Enter Password is Required."
                ]
            );

            $customer = CustomerAndShopkeeper::where("email", $request->email)->first();
            $admin = Admin::where("email", $request->email)->first();

            if ($admin) {
                if ($request->password == $admin->password) {
                    Session::put("adminname", $admin->name);
                    return redirect()->route("admindashboard");
                } else {
                    return redirect()->back()->with("passworderror", "The password is Invalid password")->withInput();
                }
            }
            if (empty($customer)) {
                return redirect()->route("error");
            }

            if (!empty($customer->rols)) {
                if (empty($customer)) {
                    return redirect()->back()->with("notfound", $customer->rols . " not found")->withInput();
                }
            }
            if ($request->password != Crypt::decryptString($customer->password)) {
                return redirect()->back()->with("passworderror", "The password is Invalid password")->withInput();
            }

            if ($customer->rols == "Customer") {
                Session::put("customerid", $customer->name);
                Session::put("customeremail", $customer->email);
                Session::forget("discountamount");
                $cart = Session::get("cart");
                if (!empty($cart)) {
                    foreach ($cart as $key => $value) {
                        $cart = new AddToCart();
                        $cart->user_id = $customer->id;
                        $cart->product_id = $key;
                        $cart->quantity = 1;
                        $cart->save();
                    }
                }
                Session::forget("cart");
                return redirect()->route("MainIndex");
            } else {
                Session::put("shopkeeperid", $customer->name);
                Session::put("shopkeeperemail", $customer->email);
                return redirect()->route("shopkeeperdashboard");
            }
        }
        return view("Main.login");
    }

    // Registration
    public function Registration(Request $request)
    {

        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);

        if ($request->isMethod("post")) {

            $validator = $request->validate([
                "name" => "required",
                "conformpassword" => [
                    "required",
                    "same:password",
                    RulesPassword::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ],
                "password" => [
                    "required",
                    RulesPassword::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ],
                "email" => "required|email|unique:CustomerAndShopkeeper,email",
                "phone" => "required|numeric|digits:10|unique:CustomerAndShopkeeper,phone",
                "address" => "required",
                "city" => "required",
                "state" => "required",
                "country" => "required",
                "pincode" => "required|numeric|digits:6",
                "gender" => "required",
            ]);

            $customer = new CustomerAndShopkeeper();
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->password = Crypt::encryptString($request->password);
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->rols = $request->rols;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->country = $request->country;
            $customer->pincode = $request->pincode;
            $customer->gender = $request->gender;
            $customer->save();

            return redirect()->route("login");
        }
        return view("Main.registration", ["contrylist" => $contrylist]);
    }

    // Forget Password
    public function Forget_Password_Email_Find(Request $request)
    {
        if ($request->isMethod("post")) {

            $request->validate([
                "email" => "required|email"
            ], [
                "email.required" => "Enter Email is Required",
                "email.email" => "Enter Only Email is Required"
            ]);

            $forgotuser = CustomerAndShopkeeper::where("email", $request->email)->first();
            if ($forgotuser) {
                Session::put("emailforgotpassword", $forgotuser->email);
                // return view("Main.ForgetPassword.forgotpassword", ['data' => $forgotuser]);
                // dd("boom");
                return redirect()->route("forget.Password.Data");
            } else {
                return back()->withInput()->with(["emailerror" => "Enter Email is Not Exist !"]);
            }
        }
        return view("Main.ForgetPassword.emailvarify");
    }
    public function Forget_Password(Request $request)
    {
        if ($request->isMethod("post")) {

            $request->validate([
                "newpassword" => "required",
                "confpassword" => "required|same:newpassword",
            ], [
                "newpassword.required" => "Enter New Password are Required",
                "confpassword.required" => "Enter Conform Password are Required",
                "confpassword.same" => "Enter Password are Not Match to New Password",
            ]);
            $shopkeeperdata = CustomerAndShopkeeper::where("email", Session::get("emailforgotpassword"))->first();
            $shopkeeperdata->password = Crypt::encryptString($request->confpassword);
            $shopkeeperdata->save();

            return redirect()->route("login");
        }
        return view("Main.ForgetPassword.forgotpassword", ["notshowemail" => "yes"]);
    }

    // Main page
    public function Index()
    {
        $data = CategoryProduct::with('productsdata')->get();

        if (Session::get("customeremail") != null) {

            // cart count
            $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $addtocart = AddToCart::where("user_id", $data1->id)->get();

            // Favourite Product
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $wishlist = FavouriceProduct::where("user_id", $user_data->id)->get();

            return view("IndexProductShow.productshow", ["cartcount" => $addtocart->count(), "data" => $data, "wishlist" => $wishlist]);
        } else {
            return view("IndexProductShow.productshow", ["data" => $data]);
        }
    }

    public function Product_id_Detail($productid)
    {
        $data = Product::where("id", $productid)->first();
        $couper = Coupen::all();
        if (Session::get("customeremail")) {

            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

            $wishlist = FavouriceProduct::where("user_id", $user_data->id)
                ->where("product_id", $productid)->first();

            $coupondata = UserCoupunData::where("user_id", $user_data->id)
                ->where("product_id", $productid)->first();

            return view("IndexProductShow.productdetail", ["productdatails" => $data, "coupen" => $couper, "coupenuserdata" => $coupondata, "wishlist" => $wishlist]);
        }
        return view("IndexProductShow.productdetail", ["productdatails" => $data, "coupen" => $couper]);
    }

    // Checkout Processes
    public function Summry_Product_Detail()
    {
        if (Session::get("customerid")) {
            $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $addtocart = AddToCart::where("user_id", $data1->id)->get();

            if ($addtocart->isEmpty()) {
                return redirect()->route("addtocart_get_all");
            }

            $coupon = UserCoupunData::where("user_id", $data1->id)->get();
            return view("IndexProductShow.CheckOut.summryproductdetail", ["cart" => $addtocart, "couponuserdata" => $coupon]);
        } else {
            return redirect()->route("login");
        }
    }

    // Cart Count - Use Ajax
    public function Cart_Count()
    {
        $cartcount = 0;
        if (Session::get("customeremail")) {

            $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $addtocart = AddToCart::where("user_id", $data1->id)->get();

            foreach ($addtocart as $key) {
                $cartcount += $key->quantity;
            }
            return response()->json(['cartcount' => $cartcount]);
        } else {

            $cart = session()->get('cart');
            foreach ($cart as $key) {
                $cartcount += $key['quantity'];
            }

            return response()->json(['cartcount' => $cartcount]);
        }
    }
    public function Checkout_Product()
    {
        // countries data
        $contentcountry = File::get(public_path('countries.json'));
        $contrylist = json_decode($contentcountry, true);

        // cart record are get
        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $addtocart = AddToCart::where("user_id", $data1->id)->get();

        // user data
        $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $data->password = Crypt::decryptString($data->password);

        // coupon data
        $coupon = UserCoupunData::where("user_id", $data1->id)->get();

        return view("IndexProductShow.CheckOut.checkoutpage", ["customerdata" => $data, "couponuserdata" => $coupon, "cart" => $addtocart, "contrylist" => $contrylist]);
    }

    public function delete_cart_summry($cartid)
    {
        $addtocart = AddToCart::find($cartid);
        $addtocart->delete();
        return redirect()->back();
    }

    public function order_product(Request $request)
    {
        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $coupon = UserCoupunData::where("user_id", $data1->id)->get();

        if ($request->isMethod("post")) {


            $addtocart = AddToCart::where("user_id", $data1->id)->get();

            foreach ($addtocart as $item) {

                $order = new CustomerOrder();
                $order->name = $request->name;
                $order->email = $request->email;
                $order->phone = $request->phone;
                $order->country = $request->country;
                $order->state = $request->state;
                $order->city = $request->city;
                $order->pincode = $request->pincode;
                $order->address = $request->address;
                $order->customer_id = $item->user_id;
                $order->product_id = $item->product_id;
                $order->quantity = $item->quantity;
                $order->status = "Pending";
                $order->order_date = now();
                $order->delivery_date = now()->addDays(7);
                $order->save();

                $product = Product::find($item->product_id);
                $product->stock = $product->stock - $item->quantity;
                $product->save();
            }

            $data = CustomerOrder::where("email", Session::get("customeremail"))->get();
            return view("IndexProductShow.Order.ordershow", ["order" => $data, "couponuserdata" => $coupon]);
        }
        $data = CustomerOrder::where("email", Session::get("customeremail"))->get();

        return view("IndexProductShow.Order.ordershow", ["order" => $data, "couponuserdata" => $coupon]);
    }

    public function order_delete($orderid)
    {
        $order = CustomerOrder::find($orderid);
        if ($order) {
            $product = Product::find($order->product_id);
            $product->stock = $product->stock + $order->quantity;
            $product->save();
            $order->delete();
        } else {
            return redirect()->back()->withErrors("not found data");
        }
        return redirect()->back();
    }

    // Main page Search Bar
    public function search_product_name(Request $request)
    {
        $data_of_input = $request->search_data;
        if ($data_of_input == '') {
            return redirect()->route("MainIndex");
        }
        $product = Product::where("name", "like", "%" . $data_of_input . "%")->get();
        return view("IndexProductShow.Search.searchproduct", ["data" => $product, "inputdata" => $data_of_input]);
    }

    public function get_category_wise_product($categoryname)
    {

        if (Session::get("customeremail")) {
            $category_data = CategoryProduct::where("category_name", $categoryname)->get();
            $all_category_data = CategoryProduct::all();
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $favourite_product_list = FavouriceProduct::where("user_id", $user_data->id)->get();
            // dd($favourite_product_list);
            return view(
                "IndexProductShow.categorywiseproductshow",
                [
                    "data" => $category_data,
                    "alldata" => $all_category_data,
                    "wishlist" => $favourite_product_list
                ]
            );
        } else {
            $category_data = CategoryProduct::where("category_name", $categoryname)->get();
            $all_category_data = CategoryProduct::all();

            return view(
                "IndexProductShow.categorywiseproductshow",
                [
                    "data" => $category_data,
                    "alldata" => $all_category_data,
                ]
            );
        }
    }

    public function add_to_favourite($productid)
    {
        if (Session::get("customeremail") != null) {

            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

            $favourite_product = new FavouriceProduct();
            $favourite_product->product_id = $productid;
            $favourite_product->user_id = $user_data->id;
            $favourite_product->save();
            return response()->json(["data" => "save"]);
        } else {
            return response()->json(["url" => route("login")]);
        }
    }

    public function wishlist()
    {
        $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $favourite_product_list = FavouriceProduct::where("user_id", $user_data->id)->get();
        return view("IndexProductShow.WishList.wishlistshow", ["wishlist" => $favourite_product_list]);
    }

    public function remove_wishlist_item($productid, Request $request)
    {
        $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $wishlist = FavouriceProduct::where("user_id", $user_data->id)
            ->where("product_id", $productid)->delete();
        if ($request->ajax()) {
            return response()->json(["data" => "delete"]);
        } else {
            return redirect()->route("wishlist");
        }
    }

    public function search_wishlist_item(Request $request)
    {
        $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $wishlist = FavouriceProduct::where("favourite_product.user_id", $user_data->id)
            ->leftJoin('products', 'favourite_product.product_id', '=', 'products.id')
            ->where("name", "like", "%" . $request->search_data . "%")
            ->get();
        return view("IndexProductShow.WishList.wishlistshow", ["wishlist" => $wishlist]);
    }

    public function discount_coupun($coupon_id, $product_id)
    {
        if (Session::get("customeremail")) {

            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $coupon = new UserCoupunData();
            $coupon->user_id = $user_data->id;
            $coupon->product_id = $product_id;
            $coupon->coupon_id = $coupon_id;
            $coupon->save();
        } else {
            Session::put("discountamount", [
                "product_id" => $product_id,
                "amount" => $coupon_id
            ]);
        }

        return redirect()->back();
    }

    public function remove_discount_coupun($product_id)
    {

        if (Session::get("customeremail")) {
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $coupon = UserCoupunData::where("user_id", $user_data->id)
                ->where("product_id", $product_id)->delete();
        } else {
            Session::forget("discountamount");
        }
        return redirect()->back();
    }
}
