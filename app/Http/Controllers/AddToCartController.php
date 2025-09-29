<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\Product;
use App\Models\UserCoupunData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddToCartController extends Controller
{
    protected $catagorydata;
    public function __construct()
    {
        $this->catagorydata = CategoryProduct::all();
    }
    // Shopkeeper
    public function index($product_id)
    {
        if (Session::get("customeremail")) {
            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))
                ->first();
            $cart = new AddToCart();
            $cart->user_id = $data->id;
            $cart->product_id = $product_id;
            $cart->quantity = 1;
            $cart->save();

            return redirect()->route("addtocart_get_all");
        } else {

            $cart = session()->get('cart', []);
            $product = Product::where("id", $product_id)->first();
            if (isset($cart[$product_id])) {
                $cart[$product_id]["quantity"] = $cart[$product_id]["quantity"] + 1;
            } else {
                $cart[$product_id] = [
                    'product_data' => $product,
                    "product_id" => $product->id,
                    'quantity' => 1,
                ];
            }
            session()->put('cart', $cart);
            return redirect()->route("addtocart_get_all");
        }
    }

    public function addtocart_get_all()
    {
        if (Session::get("customeremail")) {

            $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $addtocart = AddToCart::where("user_id", $data1->id)->get();
            $couponuserdata = UserCoupunData::where("user_id", $data1->id)->get();
            return view("IndexProductShow.AddToCart.addtocartindex", ["datacart" => $addtocart, "usercoupondata" => $couponuserdata]);
        } else {

            $cart = session()->get('cart');
            // dd($cart);
            return view("IndexProductShow.AddToCart.addtocartindex", ["datacart" => $cart]);
        }
    }

    public function delete_cart($cartid)
    {

        if (session()->get('cart')) {

            $cart = session()->get('cart');
            unset($cart[$cartid]);
            $cart = array_values($cart);
            session()->put('cart', $cart);
            return redirect()->route("addtocart_get_all");
        } elseif (Session::get("customeremail")) {

            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $addtocart1 = AddToCart::where("product_id", $cartid)
                ->where("user_id", $data->id)->first();
            $addtocart1->delete();
            return redirect()->route("addtocart_get_all");
        }
    }

    public function update_queantity(Request $request)
    {
        if (Session::get("customeremail")) {

            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $addtocart1 = AddToCart::where("product_id", $request->product_id)
                ->where("user_id", $data->id)->first();
            if ($request->queantity == 0) {
                $addtocart1->delete();
            } else {
                $addtocart1->quantity = $request->queantity;
                $addtocart1->save();
            }
        } else {

            $cart = session()->get('cart', []);
            if ($cart[$request->product_id]) {
                $cart_data_find = $cart[$request->product_id];
                if ($cart[$request->product_id]["quantity"] > $request->queantity) {
                    $cart[$request->product_id]["quantity"] = $cart[$request->product_id]["quantity"] - 1;
                } else {
                    $cart[$request->product_id]["quantity"] = $cart[$request->product_id]["quantity"] + 1;
                }
                session()->put('cart', $cart);
                if ($cart[$request->product_id]["quantity"] == 0) {
                    // dd($cart_data_find);
                    unset($cart[$request->product_id]);
                }
            }
        }
        return response()->json([
            'status' => 'success',
            'redirect_url' => route('addtocart_get_all')
        ]);
    }
}
