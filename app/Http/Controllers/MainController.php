<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            return redirect()->route("summryproductdetail");
        }
        else
        {
            return redirect()->route("customerlogin");
        }
        // return view("IndexProductShow.CheckOut.checkoutpage");
    }

    public function checkout_product()
    {
        // category data
        $contentcountry = File::get(public_path('countries.json'));
        $contrylist = json_decode($contentcountry, true);

        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $addtocart = AddToCart::where("user_id", $data1->id)->get();
        return view("IndexProductShow.CheckOut.checkoutpage",["cart"=>$addtocart,"contrylist" => $contrylist]);
    }

    public function summry_product_detail()
    {
        $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $addtocart = AddToCart::where("user_id", $data1->id)->get();

        if($addtocart->isEmpty())
        {
            return redirect()->route("addtocart_get_all");
        }
        return view("IndexProductShow.CheckOut.summryproductdetail",["cart"=>$addtocart]);
    }

    public function delete_cart_summry($cartid)
    {
        $addtocart = AddToCart::find($cartid);
        $addtocart->delete();
        return redirect()->back();
    }

    public function order_product(Request $request)
    {
        dd($request->all());
    }
}
