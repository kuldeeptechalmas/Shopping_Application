<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index(){
        
        return view("IndexProductShow.productshow");
    }

    public function main_product_get_all(){
        $data = CategoryProduct::with('productsdata')->get();
        return view("IndexProductShow.product",["data"=>$data]);
    }

    public function product_details($productid)
    {
       
        $data = Product::where("id", $productid)->first();
        return view("IndexProductShow.productdetail", ["productdatails" => $data]);
    }

    public function checkout_page()
    {
        $cart=Session::get("cart");
        // dd($cart);
        if(Session::get("shopkeeperid"))
        {
            return redirect()->route("");
        }
        elseif(Session::get("customerid"))
        {
            return redirect()->route("");
        }
        else
        {
            return redirect()->route("customerlogin");
        }
        // return view("IndexProductShow.CheckOut.checkoutpage");
    }
}
