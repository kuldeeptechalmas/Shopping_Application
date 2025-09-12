<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
