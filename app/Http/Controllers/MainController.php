<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\CustomerOrder;
use App\Models\FavouriceProduct;
use App\Models\Product;
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
        if (Session::get("customeremail")) {
            $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $wishlist = FavouriceProduct::where("user_id", $user_data->id)
                ->where("product_id", $productid)->first();
            return view("IndexProductShow.productdetail", ["productdatails" => $data, "wishlist" => $wishlist]);
        }
        return view("IndexProductShow.productdetail", ["productdatails" => $data]);
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

        return view("IndexProductShow.CheckOut.checkoutpage", ["customerdata" => $data, "cart" => $addtocart, "contrylist" => $contrylist]);
    }

    public function summry_product_detail()
    {
        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $addtocart = AddToCart::where("user_id", $data1->id)->get();

        if ($addtocart->isEmpty()) {
            return redirect()->route("addtocart_get_all");
        }
        return view("IndexProductShow.CheckOut.summryproductdetail", ["cart" => $addtocart]);
    }

    public function delete_cart_summry($cartid)
    {
        $addtocart = AddToCart::find($cartid);
        $addtocart->delete();
        return redirect()->back();
    }

    public function order_product(Request $request)
    {
        if ($request->isMethod("post")) {


            $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
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
                $order->order_date = now();
                $order->delivery_date = now()->addDays(7);
                $order->save();

                $product = Product::find($item->product_id);
                $product->stock = $product->stock - $item->quantity;
                $product->save();
            }

            $data = CustomerOrder::where("email", Session::get("customeremail"))->get();
            return view("IndexProductShow.Order.ordershow", ["order" => $data]);
        }
        $data = CustomerOrder::where("email", Session::get("customeremail"))->get();

        return view("IndexProductShow.Order.ordershow", ["order" => $data]);
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
        $product = Product::where("name", "like", "%" . $request->search_data . "%")->get();
        return response()->json(["product_data" => $product]);
    }

    public function get_category_wise_product($categoryname)
    {
        try {

            $category_data = CategoryProduct::where("category_name", $categoryname)->get();
            $all_category_data = CategoryProduct::all();
            // $product_data = Product::where("category_id", $category_data->id)->get();
            return view("IndexProductShow.categorywiseproductshow", ["data" => $category_data, "alldata" => $all_category_data]);
        } catch (Exception $th) {
            return response()->with("Not found data");
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
            return redirect()->back();
        }
    }
}
