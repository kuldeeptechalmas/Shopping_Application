<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\CustomerAndShopkeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddToCartController extends Controller
{
    // Shopkeeper
    public function index($product_id)
    {
        $data=CustomerAndShopkeeper::where("name",Session::get("shopkeeperid"))->first();
        $addtocart=new AddToCart();
        $addtocart->user_id=$data->id;
        $addtocart->product_id=$product_id;
        $addtocart->quantity=1;
        $addtocart->save();

        $addtocart1=AddToCart::where("user_id",$data->id)->get();

        return view("Shopkeeper.AddToCart.addtocartmain",["datacart"=>$addtocart1]);
    }

    public function addtocart_get_all()
    {
        $data=CustomerAndShopkeeper::where("name",Session::get("shopkeeperid"))->first();
        $addtocart1=AddToCart::where("user_id",$data->id)->get();
         return view("Shopkeeper.AddToCart.addtocartmain",["datacart"=>$addtocart1]);
    }
}
