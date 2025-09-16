<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\Product;
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
        $data = CustomerAndShopkeeper::where("name", Session::get("shopkeeperid"))
            ->first();

        if (isset($data)) {
            $addtocarts = AddToCart::where("user_id", $data->id)
                ->where("product_id", $product_id)->first();

            if (!isset($addtocarts)) {
                $cart = new AddToCart();
                $cart->user_id = $data->id;
                $cart->product_id = $product_id;
                $cart->quantity = 1;
                $cart->save();
            }

            $addtocart1 = AddToCart::where("user_id", $data->id)->get();
            return view("Shopkeeper.AddToCart.addtocartmain", ["datacart" => $addtocart1, "catagory" => $this->catagorydata]);
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
        $data = CustomerAndShopkeeper::where("name", Session::get("shopkeeperid"))->first();
        if (isset($data)) {
            $addtocart1 = AddToCart::where("user_id", $data->id)->get();
            return view("Shopkeeper.AddToCart.addtocartmain", ["datacart" => $addtocart1, "catagory" => $this->catagorydata]);
        } else {

            $cart = session()->get('cart');
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
        } else {

            $addtocart = AddToCart::find($cartid);
            $addtocart->delete();
            $data = CustomerAndShopkeeper::where("name", Session::get("shopkeeperid"))->first();
            $addtocart1 = AddToCart::where("user_id", $data->id)->get();
            return view("Shopkeeper.AddToCart.addtocartmain", ["datacart" => $addtocart1, "catagory" => $this->catagorydata]);
        }
    }

    public function update_queantity(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->product_id])) {
            if ($cart[$request->product_id]["quantity"] > $request->queantity) {
                $cart[$request->product_id]["quantity"] = $cart[$request->product_id]["quantity"] - 1;
            } else {
                $cart[$request->product_id]["quantity"] = $cart[$request->product_id]["quantity"] + 1;
            }
        }
        session()->put('cart', $cart);

         return response()->json([
            'status' => 'success',
            'redirect_url' => route('addtocart_get_all')
        ]);
    }
}
