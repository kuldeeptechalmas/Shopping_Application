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
use App\Models\Rating;
use App\Models\SubCatagory;
use App\Models\UserCoupunData;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use PhpParser\Node\Expr\Cast\Void_;
use App\Services\SmsService;

class MainController extends Controller
{

    // Login
    public function Login(Request $request)
    {
        if ($request->isMethod("post")) {

            $validator = Validator::make(
                $request->all(),
                [
                    'email' => ['required', 'email:rfc,dns', 'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo)\.com$/'],
                ],
                [
                    'email.required' => 'Enter Email is Required.',
                    'email.email' => 'Enter Email Must Be A Valid Email Address.',
                    'email.regex' => 'The email must be from an allowed domain (gmail.com, yahoo.com).',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $userData = CustomerAndShopkeeper::where("email", "like", "%" . $request->email . "%")->get();
            if ($userData->count() == 0) {
                $adminData = Admin::where("email", "like", "%" . $request->email . "%")->get();

                if ($adminData->count() == 0) {
                    return redirect()->back()->withErrors(["email" => "Email User Not Exist !"])->withInput();
                }
            }

            $validator1 = Validator::make(
                $request->all(),
                [
                    "password" => "required",
                ],
                [
                    "password.required" => "Enter Password is Required."
                ]
            );
            if ($validator1->fails()) {
                return redirect()->back()->withErrors($validator1)->withInput();
            }

            $customer = CustomerAndShopkeeper::where("email", $request->email)->first();
            $admin = Admin::where("email", $request->email)->first();

            if ($admin) {
                if ($request->password == $admin->password) {
                    Session::put("adminname", $admin->name);
                    return redirect()->route("admindashboard");
                } else {
                    return redirect()->back()->with("password", "The password is Invalid password")->withInput();
                }
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

                $cart = Session::get('gest_addtocart_data');
                if (!empty($cart)) {
                    foreach ($cart as $key => $value) {

                        $ExistAddToCart = AddToCart::where("product_id", $key)
                            ->where("user_id", $customer->id)->first();

                        if (!$ExistAddToCart) {
                            $productData = Product::find($key);
                            $productData->stock -= $value['quantity'];
                            $productData->save();

                            if ($productData->stock == 0) {
                                $productData->status = "out of stock";
                                $productData->save();
                            } else {
                                $productData->status = "in stock";
                                $productData->save();
                            }
                            $cart = new AddToCart();
                            $cart->user_id = $customer->id;
                            $cart->product_id = $key;
                            $cart->quantity = $value['quantity'];
                            $cart->save();
                        }
                    }
                    Session::forget('gest_addtocart_data');
                    return redirect()->route("addtocart_get_all");
                }

                $cartBuyNow = Session::get('gest_CartBuyNow');
                if ($cartBuyNow) {

                    $productIdSession = Session::get('productId');
                    $productData = Product::find($productIdSession);
                    $productData->stock -= $cartBuyNow[$productIdSession]['quantity'];
                    $productData->save();

                    if ($productData->stock == 0) {
                        $productData->status = "out of stock";
                        $productData->save();
                    } else {
                        $productData->status = "in stock";
                        $productData->save();
                    }
                    $ExistAddToCart = AddToCart::where("product_id", $productIdSession)->where("user_id", $customer->id)->first();

                    if (!$ExistAddToCart) {
                        $cart = new AddToCart();
                        $cart->user_id = $customer->id;
                        $cart->product_id = $productIdSession;
                        $cart->quantity = $cartBuyNow[$productIdSession]['quantity'];
                        $cart->save();
                    }
                    Session::forget('gest_CartBuyNow');
                    return redirect()->route("buy.Now.Summary", ['productId' => Session::get('productId')]);
                }
                return redirect()->route("MainIndex");
            } else {
                Session::forget("cart");
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
        $countrycode = File::get(public_path('countryandcode.json'));
        $contrycodelist = json_decode($countrycode, true);

        if ($request->isMethod("post")) {

            $request->validate([
                "name" =>  [
                    'required',
                    'regex:/^[a-zA-Z0-9\s]+$/',
                    'not_regex:/^\d+$/',
                ],
                "password" => [
                    "required",
                    Password::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers(),
                ],
                "conformpassword" => [
                    "required",
                    "same:password",
                ],
                'email' => [
                    'required',
                    'email:rfc,dns',
                    'unique:CustomerAndShopkeeper,email',
                    'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo)\.com$/'
                ],
                "countrycode" => 'string|size:2',
                "phone" => "required|numeric|unique:CustomerAndShopkeeper,phone|phone:countrycode",
                "address" => "required",
                "city" => "required",
                "state" => "required",
                "country" => "required",
                "pincode" => "required|numeric|digits:6",
                "gender" => "required",
            ], [
                "name.required" => 'Enter Name is Required.',
                "name.not_regex" => 'Enter Name Format is valid.',

                "password.required" => 'Enter Password is Required.',
                "password.min" => 'Enter Password Min 8 Letter.',
                'password.mixed' => 'Enter password must contain At least One Uppercase and One Lowercase letter.',
                "password.symbols" => 'Enter Password Symbols.',
                "password.numbers" => 'Enter Password Number.',

                "conformpassword.required" => 'Enter ConForm password is Required.',
                "conformpassword.same" => 'Enter ConForm password is Not Same Password.',

                "phone.required" => 'Enter Phone is Required.',
                "phone.phone" => 'Enter Currect Phone number to ' . $request->countrycode . '.',

                "address.required" => 'Enter Address is Required.',
                "city.required" => 'Enter City is Required.',
                "state.required" => 'Enter State is Required.',
                "country.required" => 'Enter Country is Required.',
                "pincode.required" => 'Enter Pincode is Required.',
                "gender.required" => 'Enter Gender is Required.',

                'email.required' => 'Enter Email is Required.',
                'email.email' => 'Enter Email Must Be A Valid Email Address.',
                'email.regex' => 'The email must be from an allowed domain (gmail.com, yahoo.com).',
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
            $customer->countrycode = $request->countrycode;
            $customer->save();

            return redirect()->route("login");
        }
        return view("Main.registration", ["contrylist" => $contrylist, 'countrycode' => $contrycodelist]);
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

            $validator = Validator::make($request->all(), [
                "confpassword" => [
                    "required",
                    "same:newpassword",
                    Password::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ],
                "newpassword" => [
                    "required",
                    Password::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ],
            ], [
                "newpassword.required" => "The new password is required.",
                "newpassword.min" => "The new password must be at least 8 characters.",
                "newpassword.symbols" => "The new password must contain at least one symbol.",
                "newpassword.numbers" => "The new password must contain at least one number.",
                "newpassword.mixedCase" => "The new password must contain at least one uppercase and one lowercase letter.",

                "confpassword.required" => "The conform password is required.",
                "confpassword.min" => "The conform password must be at least 8 characters.",
                "confpassword.symbols" => "The conform password must contain at least one symbol.",
                "confpassword.numbers" => "The conform password must contain at least one number.",
                "confpassword.mixedCase" => "The conform password must contain at least one uppercase and one lowercase letter.",

                "confpassword.same" => "The new password and conform password do not match.",
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $shopkeeperdata = CustomerAndShopkeeper::where("email", Session::get("emailforgotpassword"))->first();
            $shopkeeperdata->password = Crypt::encryptString($request->confpassword);
            $shopkeeperdata->save();

            return redirect()->route("login");
        }
        return view("Main.ForgetPassword.forgotpassword", ["notshowemail" => "yes"]);
    }

    // Main page
    public function Index(Request $request)
    {
        if ($request->isMethod("post")) {

            // Search Product 
            if ($request->action == "Search") {

                $data_of_input = $request->search_data;
                if ($data_of_input == '') {
                    return redirect()->route("MainIndex");
                }

                $subcategories_Search_Product_Data = SubCatagory::where("name", ucfirst($data_of_input))->first();
                if ($subcategories_Search_Product_Data == null) {
                    $sub_id = 0;
                } else {
                    $sub_id = $subcategories_Search_Product_Data->id;
                }

                $product = Product::where("name", "like", "%{$data_of_input}%")
                    ->orWhere("brand", "like", "%{$data_of_input}%")
                    ->orWhere("sub_category_id", $sub_id)
                    ->get();

                $productData = $product->first();

                $categoryname = $productData->category->category_name ?? '';
                $subcategoryname = $productData->subcategory->name ?? '';

                if ($subcategoryname != "") {

                    $Brand_Name_Get = SubCatagory::where('name', $subcategoryname)->first();
                    $Brand_name_Product = Product::select('brand', DB::raw("count(*) as total"))
                        ->groupBy('brand')
                        ->where("sub_category_id", $Brand_Name_Get->id)
                        ->get();
                } else {
                    $Brand_name_Product = "";
                }

                // Favourite Product
                if (Session::get("customeremail")) {
                    $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
                    $wishlist = FavouriceProduct::where("user_id", $user_data->id)->get();

                    return view(
                        "IndexProductShow.Search.searchproduct",
                        [
                            "data" => $product,
                            "brandproduct" => $Brand_name_Product,
                            "categoryname" => $categoryname,
                            "subcategoryname" => $subcategoryname,
                            "inputdata" => $data_of_input,
                            "wishlist" => $wishlist
                        ]
                    );
                }

                return view(
                    "IndexProductShow.Search.searchproduct",
                    [
                        "data" => $product,
                        "brandproduct" => $Brand_name_Product,
                        "categoryname" => $categoryname,
                        "subcategoryname" => $subcategoryname,
                        "inputdata" => $data_of_input
                    ]
                );
            }
        }
        $data = CategoryProduct::with('productsdata')->get();

        // Top Five Record to Rated
        $Top_Products_With_Ratings = DB::table('products')
            ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.image', 'products.discount', DB::raw('AVG(rating_product.rate) as average_rating'))
            ->RightJoin('rating_product', 'products.id', '=', 'rating_product.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderBy('average_rating', 'DESC')
            ->take(5)
            ->get();


        if (Session::get("customeremail") != null) {

            // cart count
            $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $addtocart = AddToCart::where("user_id", $data1->id)->get();

            // Favourite Product
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $wishlist = FavouriceProduct::where("user_id", $user_data->id)->get();

            return view("IndexProductShow.productshow", ["cartcount" => $addtocart->count(), "data" => $data, "wishlist" => $wishlist, "TopRateProduct" => $Top_Products_With_Ratings]);
        } else {
            return view("IndexProductShow.productshow", ["data" => $data, "TopRateProduct" => $Top_Products_With_Ratings]);
        }
    }

    // Product Detail Main Page
    public function Product_id_Detail($productid)
    {
        $data = Product::where("id", $productid)->first();
        $couper = Coupen::all();

        // Suggetion Product Show
        $SuggestionProduct = Product::where('sub_category_id', $data->sub_category_id)
            ->where("category_id", $data->category_id)
            ->where('id', '!=', $data->id)
            ->get();

        if (Session::get("customeremail")) {

            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

            $wishlistProduct = FavouriceProduct::where("user_id", $user_data->id)
                ->where("product_id", $productid)->first();

            $coupondata = UserCoupunData::where("user_id", $user_data->id)
                ->where("product_id", $productid)->first();

            // Favourite Product
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $wishlist = FavouriceProduct::where("user_id", $user_data->id)->get();
            $rating_data = Rating::where('user_id', $user_data->id)
                ->where("product_id", $productid)
                ->get();

            return view("IndexProductShow.productdetail", ['ratingdata' => $rating_data, "productdatails" => $data, "coupen" => $couper, "coupenuserdata" => $coupondata, "wishlist" => $wishlist, "wishlistProduct" => $wishlistProduct, 'SuggestionProduct' => $SuggestionProduct]);
        }
        return view("IndexProductShow.productdetail", ["productdatails" => $data, "coupen" => $couper, 'SuggestionProduct' => $SuggestionProduct]);
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
        }
    }
    public function Checkout_Product(Request $request)
    {
        // countries data
        $contentcountry = File::get(public_path('countries.json'));
        $contrylist = json_decode($contentcountry, true);

        // cart record are get

        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        if (isset($request->productId)) {
            $addtocart = AddToCart::where("user_id", $data1->id)
                ->where("product_id", $request->productId)->get();

            // Session::put("productId", $addtocart[0]->product_id);
        } else {
            $addtocart = AddToCart::where("user_id", $data1->id)->get();
        }

        // user data
        $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $data->password = Crypt::decryptString($data->password);

        // coupon data
        $coupon = UserCoupunData::where("user_id", $data1->id)->get();

        return view("IndexProductShow.CheckOut.checkoutpage", ["customerdata" => $data, "couponuserdata" => $coupon, "cart" => $addtocart, "contrylist" => $contrylist]);
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

    // Delete Summry in Check out Time
    public function delete_cart_summry($cartid)
    {
        $addtocart = AddToCart::find($cartid);
        $addtocart->delete();
        return redirect()->back();
    }

    // Order
    public function order_product(Request $request)
    {

        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $coupon = UserCoupunData::where("user_id", $data1->id)->get();

        // Search Order Data
        if ($request->action == "Search") {
            $searchData = $request->search_data;
            $data = CustomerOrder::whereHas("product", function ($query) use ($searchData) {
                $query->where("name", "like", "%" . $searchData . "%");
            })->where("email", Session::get("customeremail"))->get();

            return view("IndexProductShow.Order.ordershow", ["order" => $data, "couponuserdata" => $coupon, 'inputdata' => $searchData]);
        }

        // Remove order
        if ($request->action == 'Remove') {

            $order = CustomerOrder::find($request->orderId);
            if ($order) {
                $product = Product::find($order->product_id);
                $product->stock = $product->stock + $order->quantity;
                $product->main_stock = $product->main_stock + $order->quantity;
                $product->save();
                $order->delete();
                $data = CustomerOrder::where("email", Session::get("customeremail"))->get();

                return view("IndexProductShow.Order.ordershow", ["order" => $data, "couponuserdata" => $coupon]);
            }
        }

        if ($request->isMethod("post")) {

            $validator = Validator::make(
                $request->all(),
                [
                    "name" =>  [
                        'required',
                        'regex:/^[a-zA-Z0-9\s]+$/',
                        'not_regex:/^\d+$/',
                    ],
                    "phone" => "required|numeric|digits:10",
                    "address" => "required",
                    "city" => "required",
                    "state" => "required",
                    "country" => "required",
                    "pincode" => "required|numeric|digits:6",
                ],
                [
                    "name.required" => "Enter name is required",
                    "email.required" => "Enter name is required",
                    "phone.required" => "Enter name is required",
                    "country.required" => "Enter name is required",
                    "city.required" => "Enter name is required",
                    "state.required" => "Enter name is required",
                    "pincode.required" => "Enter name is required",
                    "address.required" => "Enter name is required",
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            if (Session::get("productId")) {
                $addtocart_buy_data = AddToCart::where("user_id", $data1->id)->where("product_id", Session::get("productId"))->get();
                Session::forget("productId");
            } else {
                $addtocart_add_to_cart = AddToCart::where("user_id", $data1->id)->get();
            }

            if (isset($addtocart_buy_data)) {
                $addtocart = $addtocart_buy_data;
            } else {
                $addtocart = $addtocart_add_to_cart;
            }
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
                $order->rate_id = 0;
                $order->save();

                $product_Stock_Change = Product::find($item->product_id);
                $product_Stock_Change->main_stock = $product_Stock_Change->main_stock - $item->quantity;
                $product_Stock_Change->save();
            }
            foreach ($addtocart as $item) {
                $deleteFind = AddToCart::find($item->id);
                $deleteFind->delete();
            }

            $data = CustomerOrder::where("email", Session::get("customeremail"))->get();
            return view("IndexProductShow.Order.ordershow", ["order" => $data, "couponuserdata" => $coupon]);
        }
        $data = CustomerOrder::where("email", Session::get("customeremail"))->get();
        $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

        return view("IndexProductShow.Order.ordershow", ["order" => $data, "couponuserdata" => $coupon]);
    }

    // Delete order
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

    // Get Product data to Category Wise
    public function get_category_wise_product($categoryname, Request $request)
    {

        // Search Product
        if ($request->isMethod("post")) {
            if ($request->action == "Search") {

                $data_of_input = $request->search_data;
                if ($data_of_input == '') {
                    return redirect()->back();
                }

                $subcategories_Search_Product_Data = SubCatagory::where("name", ucfirst($data_of_input))->first();
                if ($subcategories_Search_Product_Data == null) {
                    $sub_id = 0;
                } else {
                    $sub_id = $subcategories_Search_Product_Data->id;
                }

                $product = Product::where("name", "like", "%{$data_of_input}%")
                    ->orWhere("brand", "like", "%{$data_of_input}%")
                    ->orWhere("sub_category_id", $sub_id)
                    ->get();

                $productData = $product->first();

                if (isset($productData)) {
                    $categoryname = $productData->category->category_name;
                    $subcategoryname = $productData->subcategory->name;
                } else {
                    $categoryname = "";
                    $subcategoryname = "";
                }

                // find Brand Name
                if ($subcategoryname != "") {

                    $Brand_Name_Get = SubCatagory::where('name', $subcategoryname)->first();
                    $Brand_name_Product = Product::select('brand', DB::raw("count(*) as total"))
                        ->groupBy('brand')
                        ->where("sub_category_id", $Brand_Name_Get->id)
                        ->get();
                } else {
                    $Brand_name_Product = "";
                }

                // dd($Brand_name_Product);

                // Favourite Product
                if (Session::get("customeremail")) {
                    $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
                    $wishlist = FavouriceProduct::where("user_id", $user_data->id)->get();
                    return view(
                        "IndexProductShow.Search.searchproduct",
                        [
                            "data" => $product,
                            "inputdata" => $data_of_input,
                            "brandproduct" => $Brand_name_Product,
                            "categoryname" => $categoryname,
                            "subcategoryname" => $subcategoryname,
                            "wishlist" => $wishlist
                        ]
                    );
                } else

                    return view(
                        "IndexProductShow.Search.searchproduct",
                        [
                            "data" => $product,
                            "categoryname" => $categoryname,
                            "brandproduct" => $Brand_name_Product,
                            "subcategoryname" => $subcategoryname,
                            "inputdata" => $data_of_input
                        ]
                    ); {
                }
            }
        }

        if (Session::get("customeremail")) {
            $category_data = CategoryProduct::where("category_name", $categoryname)->get();
            $all_category_data = CategoryProduct::all();
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $favourite_product_list = FavouriceProduct::where("user_id", $user_data->id)->get();

            // dd($category_data);

            return view(
                "IndexProductShow.categorywiseproductshow",
                [
                    "data" => $category_data,
                    "categoryname" => $categoryname,
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
                    "categoryname" => $categoryname,
                    "alldata" => $all_category_data,
                ]
            );
        }
    }

    // Get Product Data to Sub Category Wise
    public function get_sub_category_wise_product($subcategoryname, Request $request)
    {
        // Search Product
        if ($request->isMethod("post")) {
            if ($request->action == "Search") {

                $data_of_input = $request->search_data;
                if ($data_of_input == '') {
                    return redirect()->back();
                }

                $subcategories_Search_Product_Data = SubCatagory::where("name", ucfirst($data_of_input))->first();
                if ($subcategories_Search_Product_Data == null) {
                    $sub_id = 0;
                } else {
                    $sub_id = $subcategories_Search_Product_Data->id;
                }

                $product = Product::where("name", "like", "%{$data_of_input}%")
                    ->orWhere("brand", "like", "%{$data_of_input}%")
                    ->orWhere("sub_category_id", $sub_id)
                    ->get();

                $productData = $product->first();

                // find Brand Name
                if ($subcategoryname != "") {

                    $Brand_Name_Get = SubCatagory::where('name', $subcategoryname)->first();
                    $Brand_name_Product = Product::select('brand', DB::raw("count(*) as total"))
                        ->groupBy('brand')
                        ->where("sub_category_id", $Brand_Name_Get->id)
                        ->get();
                } else {
                    $Brand_name_Product = "";
                }

                // Favourite Product
                if (Session::get("customeremail")) {
                    $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
                    $wishlist = FavouriceProduct::where("user_id", $user_data->id)->get();

                    return view(
                        "IndexProductShow.Search.searchproduct",
                        [
                            "data" => $product,
                            "categoryname" => $productData->category->category_name,
                            "subcategoryname" => $productData->subcategory->name,
                            "inputdata" => $data_of_input,
                            "brandproduct" => $Brand_name_Product,
                            "wishlist" => $wishlist
                        ]
                    );
                } else

                    return view(
                        "IndexProductShow.Search.searchproduct",
                        [
                            "data" => $product,
                            "brandproduct" => $Brand_name_Product,
                            "categoryname" => $productData->category->category_name,
                            "subcategoryname" => $productData->subcategory->name,
                            "inputdata" => $data_of_input
                        ]
                    ); {
                }
            }
        }


        $category_data = SubCatagory::where("name", $subcategoryname)->get();
        $find_Category_name = CategoryProduct::find($category_data[0]->catagroy_id);


        if (Session::get("customeremail")) {
            $all_category_data = CategoryProduct::all();
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $favourite_product_list = FavouriceProduct::where("user_id", $user_data->id)->get();

            return view(
                "IndexProductShow.categorywiseproductshow",
                [
                    "data" => $category_data,
                    "alldata" => $all_category_data,
                    "categoryname" => $find_Category_name->category_name,
                    "wishlist" => $favourite_product_list
                ]
            );
        } else {
            $category_data = SubCatagory::where("name", $subcategoryname)->get();
            $all_category_data = CategoryProduct::all();

            return view(
                "IndexProductShow.categorywiseproductshow",
                [
                    "data" => $category_data,
                    "categoryname" => $find_Category_name->category_name,
                    "alldata" => $all_category_data,
                ]
            );
        }
    }

    // Add to Favourite List
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

    // Wish List Get All
    public function wishlist(Request $request)
    {
        $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        if ($user_data) {

            $favourite_product_list = FavouriceProduct::where("user_id", $user_data->id)->get();
            if ($request->isMethod("post")) {

                // Search Wish List in Data
                if ($request->action == "Search") {
                    $wishlist = FavouriceProduct::where("favourite_product.user_id", $user_data->id)
                        ->leftJoin('products', 'favourite_product.product_id', '=', 'products.id')
                        ->where("name", "like", "%" . $request->search_data . "%")
                        ->get();
                    return view("IndexProductShow.WishList.wishlistshow", ["wishlist" => $wishlist, "inputdata" => $request->search_data]);
                }

                // Remove Wish List in Data
                if ($request->action == "Remove") {
                    $wishlist = FavouriceProduct::where("user_id", $user_data->id)
                        ->where("product_id", $request->productId)->delete();

                    $newRecord = FavouriceProduct::where("user_id", $user_data->id)->get();
                    return view("IndexProductShow.WishList.wishlistshow", ["wishlist" => $newRecord]);
                }
            }
            return view("IndexProductShow.WishList.wishlistshow", ["wishlist" => $favourite_product_list]);
        }
    }

    // Delete in Wish List
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

    // Coupon Apply
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

    // Delete Coupon
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

    // Buy Now Functionality
    public function Buy_Now_Functionality_Customer($productId)
    {
        $UserExist = CustomerAndShopkeeper::where("email", Session::get('customeremail'))->first();

        if (isset($UserExist)) {
            $findCartData = AddToCart::where("user_id", $UserExist->id)
                ->where("product_id", $productId)->first();

            if ($findCartData) {
                return redirect()->route('buy.Now.Summary', ['productId' => $productId]);
            } else {
                Session::put("productId", $productId);
                // dd(Session::get("productId"));
                $cart = new AddToCart();
                $cart->user_id = $UserExist->id;
                $cart->product_id = $productId;
                $cart->message = "";
                $cart->quantity = 1;
                $cart->save();

                $product = Product::find($productId);
                $product->stock = $product->stock - 1;
                $product->save();
            }
            return redirect()->route('buy.Now.Summary', ['productId' => $productId]);
        } else {
            $cart = array();
            $product = Product::where("id", $productId)->first();
            $cart[$productId] = [
                "product_id" => $product->id,
                'quantity' => 1,
            ];
            Session::put("productId", $productId);
            Session::put("gest_CartBuyNow", $cart);

            return redirect()->route("login");
        }
    }

    // Show
    public function Buy_Now_Summary(Request $request)
    {
        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $addtocart = AddToCart::where("user_id", $data1->id)->where("product_id", $request->productId)->get();
        $couponuserdata = UserCoupunData::where("user_id", $data1->id)->get();

        return view("IndexProductShow.BuyNow.OrderSummary", ["datacart" => $addtocart, "usercoupondata" => $couponuserdata]);
    }

    // Email Check - Login
    //  public function Login_Email_Check(Request $request)
    // {
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'searchData' => ['regex:/^.+\.com$/i'],
    //         ]
    //     );
    //     if ($validator->fails()) {
    //         return Response()->json(["emailError" => "notShow"]);
    //     }

    //     $validator2 = Validator::make(
    //         $request->all(),
    //         [
    //             'searchData' => ['email'],
    //         ]
    //     );
    //     if ($validator2->fails()) {
    //         return Response()->json(["emailError" => "Enter Email Must Be A Valid Email Address."]);
    //     }

    //     $validator1 = Validator::make(
    //         $request->all(),
    //         [
    //             'searchData' => ['regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo)\.com$/'],
    //         ]
    //     );
    //     if ($validator1->fails()) {
    //         return Response()->json(["emailError" => "The email must be from an allowed domain (gmail.com, yahoo.com)."]);
    //     }

    //     $userData = CustomerAndShopkeeper::where("email", "like", "%" . $request->searchData . "%")->get();

    //     if ($userData->count() == 0) {

    //         $adminData = Admin::where("email", "like", "%" . $request->searchData . "%")->get();

    //         if ($adminData->count() == 0) {
    //             return Response()->json(["emailError" => "Email User Not Exist !"]);
    //         } else {
    //             return Response()->json(["emailError" => "notShow"]);
    //         }
    //     } else {
    //         return Response()->json(["emailError" => "notShow"]);
    //     }
    // }
}
