<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\Images;
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

        $validator = $request->validate(
            [
                "name" => "required",
                "description" => "required",
                "price" => "required|numeric|gt:0",
                "stock" => "required|numeric|gt:-1",
                "status" => "required",
                "image.*" => "required|image|mimes:png,jpg|max:2048",
                "catagory" => "required",
            ],
            [
                "name.required" => "Enter Name Are Required.",
                "description.required" => "Enter Description Are Required.",
                "price.required" => "Enter Price Are Required.",
                "price.numeric" => "Enter Price Is Numeric Required.",
                "price.gt" => "Enter Price Is Greater Then 0 Required.",
                "stock.required" => "Enter Stock Are Required.",
                "stock.numeric" => "Enter Stock Is Numeric Required.",
                "stock.gt" => "Enter Stock Is Greater Then -1 Required.",
                "status.required" => "Enter Status Are Required.",
                "image.required" => "Enter Image Are Required.",
                "image.image" => "Enter Only Image Are Required.",
                "image.mimes" => "Enter PNG Or JPG Image Are Required.",
                "image.max" => "Enter Less then 2 Mb Image Are Required.",
                "catagory.required" => "Enter Catagory Are Required.",
            ]
        );

        $product = Product::find($request->id);
        if ($product) {

            $admin = Admin::where("name", $request->adminid)->first();

            $product->update([
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "stock" => $request->stock,
                "status" => $request->status,
                "sub_category_id" => $request->catagory,
            ]);

            if ($admin) {
                $product->admin_id = $admin->id;
                $product->save();
            }
            if ($files = $request->file("file")) {
                foreach ($files as $file) {
                    $file->storeAs("public/UploadeFile", $file->getClientOriginalName());
                    $image = new Images();
                    $image->image_name = $file->getClientOriginalName();
                    $image->product_id = $product->id;
                    $image->save();
                }
            }
        } else {
            $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();

            $product = new Product();
            $product->category_id = $request->catagoryid;
            $product->sub_category_id  = $request->catagory;
            $product->user_id = $user->id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->status = $request->status;
            $product->admin_id = 0;
            $product->image = $request->file("image")[0]->getClientOriginalName();
            $product->save();

            if ($files = $request->file("image")) {
                foreach ($files as $file) {
                    $file->storeAs("public/UploadeFile", $file->getClientOriginalName());
                    $image = new Images();
                    $image->image_name = $file->getClientOriginalName();
                    $image->product_id = $product->id;
                    $image->save();
                }
            }
        }

        return response()->json(["success" => "save"]);
    }

    public function Admin_product_get_all(Request $request)
    {
        return view("Admin.Table.productshow");
    }

    public function product_get_all(Request $request)
    {
        $data = Product::paginate(10);

        if ($request->ajax()) {
            return view("Admin.Table.producttable", ["data" => $data, "table" => "product"]);
        }

        return view("Admin.Table.producttable", ["data" => $data]);
        // return view("Admin.Table.productshow");
    }

    // public function product_edit(Request $request)

    // {
    //     $request->validate(
    //         [
    //             "name" => "required",
    //             "description" => "required",
    //             "price" => "required|numeric",
    //             "stock" => "required|numeric",
    //             "status" => "required",
    //             "catagory" => "required",
    //             "file.*" => "required|image|mimes:png,jpg|max:2048",
    //         ],
    //         [
    //             "name.required" => "Enter Name Are Required.",
    //             "description.required" => "Enter Description Are Required.",
    //             "price.required" => "Enter Price Are Required.",
    //             "price.numeric" => "Enter Price Is Numeric Required.",
    //             "price.gt" => "Enter Price Is Greater Then 0 Required.",
    //             "stock.required" => "Enter Stock Are Required.",
    //             "stock.numeric" => "Enter Stock Is Numeric Required.",
    //             "stock.gt" => "Enter Stock Is Greater Then -1 Required.",
    //             "status.required" => "Enter Status Are Required.",
    //             "image.required" => "Enter Image Are Required.",
    //             "image.image" => "Enter Only Image Are Required.",
    //             "image.mimes" => "Enter PNG Or JPG Image Are Required.",
    //             "image.max" => "Enter Less then 2 Mb Image Are Required.",
    //             "catagory.required" => "Enter Catagory Are Required.",
    //         ]
    //     );


    //     $product = Product::find($request->id);

    //     $admin = Admin::where("name", $request->adminid)->first();

    //     $product->update([
    //         "name" => $request->name,
    //         "description" => $request->description,
    //         "price" => $request->price,
    //         "stock" => $request->stock,
    //         "status" => $request->status,
    //         "sub_category_id" => $request->catagory,
    //     ]);

    //     if ($admin) {
    //         $product->admin_id = $admin->id;
    //         $product->save();
    //     }
    //     if ($files = $request->file("file")) {
    //         foreach ($files as $file) {
    //             $file->storeAs("public/UploadeFile", $file->getClientOriginalName());
    //             $image = new Images();
    //             $image->image_name = $file->getClientOriginalName();
    //             $image->product_id = $product->id;
    //             $image->save();
    //         }
    //     }

    //     return response()->json(["success" => "save"]);
    // }

    
    public function product_remove(Request $request)
    {
        $db = Product::find($request->id)->first();
        if ($db) {
            return response()->json(["success" => "delete"]);
        } else {
            return response()->json(["error" => "Data is not Found"]);
        }
    }

    public function product_search(Request $request)
    {

        $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();

        if (isset($request->catagoryid)) {

            $data1 = Product::where("user_id", $user->id)->where("category_id", $request->catagoryid)->where("name", "like", "%" . $request->searchText . "%")->paginate(10);
            if ($data1->count() == 0) {
                return view("Shopkeeper.Product.notfoundproduct");
            } else {
                return view("Shopkeeper.Product.productshow", ["data" => $data1]);
            }
        } else {

            $data = Product::where("name", "like", "%" . $request->searchText . "%")->paginate(10);
            if ($data->count() == 0) {
                return view("Shopkeeper.Product.notfoundproduct");
            } else {
                return view("Shopkeeper.Product.productshow", ["data" => $data]);
            }
        }
    }

    public function product_list_get_shopkeeper(Request $request)
    {
        $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();
        if (isset($request->catagoryid)) {

            $data1 = Product::where("user_id", $user->id)->where("category_id", $request->catagoryid)->paginate(10);
            return view("Shopkeeper.Product.productshow", ["data" => $data1]);
        } else {

            $data = Product::where("user_id", $user->id)->paginate(10);
            if ($request->ajax()) {
                return view("Shopkeeper.Product.productshow", ["data" => $data]);
            }
            return view("Shopkeeper.Product.productshow", ["data" => $data]);
        }
    }

    public function product_add_show(Request $request, $catagory)
    {
        $catagorydata = CategoryProduct::all();
        Session::put("categoryname", $catagory);
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

    public function product_details($productid)
    {
        $catagorydata = CategoryProduct::all();
        $data = Product::where("id", $productid)->first();
        if(!empty(Session::get("adminname")))
        {
            return view("Admin.productdetail", ["productdatails" => $data, "catagory" => $catagorydata,]);
        }
        else
        {
            return view("Shopkeeper.productdetail", ["productdatails" => $data, "catagory" => $catagorydata,]);
        }
    }

    public function product_view($productid)
    {
        $data = CategoryProduct::where("category_name", Session::get("categoryname"))->first();
        $subcatagorydata = SubCatagory::where("catagroy_id", $data->id)->get();
        $productdata = Product::where("id", $productid)->first();
        return view("Shopkeeper.Product.viewproduct", [
            "product_data" => $productdata,
            "subcatagory" => $subcatagorydata
        ]);
    }
}
