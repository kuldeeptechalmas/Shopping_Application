<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\Product;
use App\Models\SubCatagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Product_Controller extends Controller
{
    public function product_add(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            "stock" => "required|numeric|gt:-1",
            "status" => "required",
            "image" => "required",
            "catagory" => "required",
        ]);

        $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();
        $path = $request->file("image")->storeAs("public/UploadeFile", $request->image->getClientOriginalName());

        $product = new Product();
        $product->category_id = $request->catagoryid;
        $product->sub_category_id  = $request->catagory;
        $product->user_id = $user->id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->image = $request->image->getClientOriginalName();
        $product->save();

        return response()->json(["success" => "save"]);
    }

    public function product_get_all(Request $request)
    {
        $data = Product::paginate(10);

        if ($request->ajax()) {
            return view("Admin.Table.producttable", ["data" => $data, "table" => "product"]);
        }

        return view("Admin.Table.producttable", ["data" => $data]);
    }

    public function product_edit(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required|numeric",
            "stock" => "required|numeric",
            "status" => "required",
            "catagory" => "required",
        ]);


        $product = Product::find($request->id);

        if (isset($request->file)) {
            $product->update([
                "image" => $request->file->getClientOriginalName(),
            ]);
            $request->file("file")->storeAs("public/UploadeFile", $request->file->getClientOriginalName());
        }

        $product->update([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "stock" => $request->stock,
            "status" => $request->status,
            "sub_category_id" => $request->catagory,
        ]);

        return response()->json(["success" => "save"]);
    }

    public function product_remove(Request $request)
    {
        $db = Product::find($request->id)->delete();
        return response()->json(["success" => "delete"]);
    }

    public function product_search(Request $request)
    {
        $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();

        if (isset($request->catagoryid)) {
            
            $data1 = Product::where("user_id", $user->id)->
            where("category_id",$request->catagoryid)->
            where("name", "like", "%" . $request->searchText . "%")->paginate(10);
            return view("Shopkeeper.Product.productshow", ["data" => $data1]);
        }
        $data = Product::where("name", "like", "%" . $request->searchText . "%")->paginate(10);
        return view("Admin.Table.producttable", ["data" => $data]);
    }

    public function product_list_get_shopkeeper(Request $request)
    {
        $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();
        if (isset($request->catagoryid)) {

            $data1 = Product::where("user_id", $user->id)->
            where("category_id",$request->catagoryid)->paginate(10);
            return view("Shopkeeper.Product.productshow", ["data" => $data1]);
        }
        
        $data = Product::where("user_id", $user->id)->paginate(10);
        if ($request->ajax()) {
            return view("Shopkeeper.Product.productshow", ["data" => $data]);
        }
        return view("Shopkeeper.Product.productshow", ["data" => $data]);
    }

    public function product_add_show(Request $request, $catagory)
    {
        $catagorydata = CategoryProduct::all();
        $data = CategoryProduct::where("category_name", $catagory)->first();
        $subcatagorydata = SubCatagory::where("catagroy_id", $data->id)->get();
        return view(
            "Shopkeeper.product_add_show",
            [
                "subcatagory" => $subcatagorydata,
                "catagory" => $catagorydata,
                "catagoryid" => $data->id
            ]
        );
    }
}
