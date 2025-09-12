<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
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

        $addtocarts = AddToCart::where("user_id", $data->id)
        ->where("product_id",$product_id)->first();

        if (!isset($addtocarts)) {
            $cart = new AddToCart();
            $cart->user_id = $data->id;
            $cart->product_id = $product_id;
            $cart->quantity = 1;
            $cart->save();
        }

        $addtocart1 = AddToCart::where("user_id", $data->id)->get();
        return view("Shopkeeper.AddToCart.addtocartmain", ["datacart" => $addtocart1, "catagory" => $this->catagorydata]);
    }

    public function addtocart_get_all()
    {
        $data = CustomerAndShopkeeper::where("name", Session::get("shopkeeperid"))->first();
        $addtocart1 = AddToCart::where("user_id", $data->id)->get();
        return view("Shopkeeper.AddToCart.addtocartmain", ["datacart" => $addtocart1, "catagory" => $this->catagorydata]);
    }

    public function delete_cart($cartid)
    {
        $addtocart = AddToCart::find($cartid);
        $addtocart->delete();
        $data = CustomerAndShopkeeper::where("name", Session::get("shopkeeperid"))->first();
        $addtocart1 = AddToCart::where("user_id", $data->id)->get();
        return view("Shopkeeper.AddToCart.addtocartmain", ["datacart" => $addtocart1, "catagory" => $this->catagorydata]);
    }
}
