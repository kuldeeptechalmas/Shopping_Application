<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
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
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {

        return view("IndexProductShow.productshow");
    }

    public function main_product_get_all()
    {
        $data = CategoryProduct::with('productsdata')->get();
        if (Session::get("customeremail") != null) {
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $wishlist = FavouriceProduct::where("user_id", $user_data->id)->get();
            return view("IndexProductShow.product", ["data" => $data, "wishlist" => $wishlist]);
        } else {
            return view("IndexProductShow.product", ["data" => $data]);
        }
    }

    public function product_details($productid)
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

    public function checkout_page()
    {
        $cart = Session::get("cart");
        // dd($cart);
        if (Session::get("shopkeeperid")) {

            return redirect()->route("");
        } elseif (Session::get("customerid")) {

            return redirect()->route("summryproductdetail");
        } else {
            return redirect()->route("customerlogin");
        }
        // return view("IndexProductShow.CheckOut.checkoutpage");
    }

    public function checkout_product()
    {
        // category data
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

    public function summry_product_detail()
    {
        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $addtocart = AddToCart::where("user_id", $data1->id)->get();

        if ($addtocart->isEmpty()) {
            return redirect()->route("addtocart_get_all");
        }

        $coupon = UserCoupunData::where("user_id", $data1->id)->get();
        return view("IndexProductShow.CheckOut.summryproductdetail", ["cart" => $addtocart, "couponuserdata" => $coupon]);
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

    public function search_product_name(Request $request)
    {
        // use json then implimented
        // $product = Product::where("name", "like", "%" . $request->search_data . "%")->get();
        // return response()->json(["product_data" => $product]);

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
            return response()->json(["url" => route("customerlogin")]);
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
