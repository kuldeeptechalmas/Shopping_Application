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
use Illuminate\Support\Facades\Validator;

class Product_Controller extends Controller
{
    // Product Add and Update
    public function product_add_and_update(Request $request)
    {
        // Edit to Product
        $product = Product::find($request->id);
        if ($product) {

            $validator = Validator::make(
                $request->all(),
                [
                    "name" =>  [
                        'required',
                        'regex:/^[a-zA-Z0-9\s.,()\[\]{}\/]+$/',
                        'not_regex:/^\d+$/',
                    ],
                    "description" => "required",
                    "price" => "required|numeric|gt:0",
                    "stock" => "required|numeric|gt:-1",
                    "status" => "required",
                    "file.*" => "image|mimes:png,jpg|max:2048",
                    "catagory" => "required",
                ],
                [
                    "name.required" => "Enter Name Are Required.",
                    "name.not_regex" => "Enter Not only Numeric Required.",
                    "description.required" => "Enter Description Are Required.",
                    "price.required" => "Enter Price Are Required.",
                    "price.numeric" => "Enter Price Is Numeric Required.",
                    "price.gt" => "Enter Price Is Greater Then 0 Required.",
                    "stock.required" => "Enter Stock Are Required.",
                    "stock.numeric" => "Enter Stock Is Numeric Required.",
                    "stock.gt" => "Enter Stock Is Greater Then -1 Required.",
                    "status.required" => "Enter Status Are Required.",
                    'file.*.image' => 'The uploaded file must be an image.',
                    'file.*.mimes' => 'Only JPEG, PNG, JPG images are allowed.',
                    'file.*.max' => 'Each image must not exceed 2MB in size.',
                    "catagory.required" => "Enter Catagory Are Required.",
                ]
            );

            if ($request->discount) {
                $validator02 = Validator::make(
                    $request->all(),
                    [
                        "discount" => "numeric",
                    ],
                    [
                        "discount.numeric" => "Enter Discount Is Numeric Required."
                    ]
                );
                if ($validator02->fails()) {
                    return redirect()->back()
                        ->withErrors($validator02)
                        ->withInput();
                }
            }

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $admin = Admin::where("name", $request->adminid)->first();

            $discountVar = 0;
            if (!$request->discount == '') {
                $discountVar = $request->discount;
            }

            $product->update([
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "stock" => $request->stock,
                "status" => $request->status,
                "sub_category_id" => $request->catagory,
                "discount" => $discountVar,
            ]);

            if ($admin) {
                $product->admin_id = $admin->id;
                $product->save();
            }
            if ($files = $request->file("file")) {

                // Image Update
                if ($product->images->count() == 1) {
                    if ($product->images[0]->image_name == "default_image.png") {
                        $ImageData = Images::find($product->images[0]->id);
                        if ($ImageData) {
                            $ImageData->delete();
                        }
                        $product->image = $request->file("file")[0]->getClientOriginalName();
                        $product->save();
                    }
                }

                foreach ($files as $file) {
                    $file->storeAs("public/UploadeFile", $file->getClientOriginalName());
                    $image = new Images();
                    $image->image_name = $file->getClientOriginalName();
                    $image->product_id = $product->id;
                    $image->save();
                }
            }
            return redirect()->back()->with("edit", "ok");
        } else {

            $validator = Validator::make(
                $request->all(),
                [
                    "name" =>  [
                        'required',
                        'regex:/^[a-zA-Z0-9\s.,()\[\]{}\/]+$/',
                        'not_regex:/^\d+$/',
                    ],
                    "description" => "required",
                    "price" => "required|numeric|gt:0",
                    "stock" => "required|numeric|gt:-1",
                    "status" => "required",
                    "file.*" => "image|mimes:png,jpg|max:2048",
                    "catagory" => "required",
                    "file" => "required",
                ],
                [
                    "name.not_regex" => "Name Not only Numeric Required.",
                    "name.required" => "Enter Name Are Required.",
                    "description.required" => "Enter Description Are Required.",
                    "price.required" => "Enter Price Are Required.",
                    "price.numeric" => "Enter Price Is Numeric Required.",
                    "price.gt" => "Enter Price Is Greater Then 0 Required.",
                    "stock.required" => "Enter Stock Are Required.",
                    "stock.numeric" => "Enter Stock Is Numeric Required.",
                    "stock.gt" => "Enter Stock Is Greater Then -1 Required.",
                    "status.required" => "Enter Status Are Required.",
                    'file.required' => 'Please upload an image.',
                    'file.*.image' => 'The uploaded file must be an image.',
                    'file.*.mimes' => 'Only JPEG, PNG, JPG images are allowed.',
                    'file.*.max' => 'Each image must not exceed 2MB in size.',
                    "catagory.required" => "Enter Catagory Are Required.",
                ]
            );

            if ($request->discount) {
                $validator02 = Validator::make(
                    $request->all(),
                    [
                        "discount" => "numeric",
                    ],
                    [
                        "discount.numeric" => "Enter Discount Is Numeric Required."
                    ]
                );
                if ($validator02->fails()) {
                    return redirect()->back()
                        ->withErrors($validator02)
                        ->withInput();
                }
            }

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $discountVar = 0;
            if (!$request->discount == '') {
                $discountVar = $request->discount;
            }

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
            $product->discount = $discountVar;
            $product->admin_id = 0;
            $product->image = $request->file("file")[0]->getClientOriginalName();
            $product->save();

            if ($files = $request->file("file")) {
                foreach ($files as $file) {
                    $file->storeAs("public/UploadeFile", $file->getClientOriginalName());
                    $image = new Images();
                    $image->image_name = $file->getClientOriginalName();
                    $image->product_id = $product->id;
                    $image->save();
                }
            }

            return redirect()->route("product.Add.Show", ["category_name" => $product->category->category_name]);
        }
    }

    // Product Add and Show to Shopkeeper
    public function product_add_show(Request $request, $catagory)
    {
        $catagorydata = CategoryProduct::all();
        if ($request->isMethod("post")) {
            // Search Product
            $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();

            if (isset($request->catagoryid)) {

                $data1 = Product::where("user_id", $user->id)->where("category_id", $request->catagoryid)->where("name", "like", "%" . $request->searchText . "%")->paginate(15);
                // dd($data1->total());
                if ($data1->total() == 0) {
                    return view("Shopkeeper.product_add_show", ["catagory" => $catagorydata, "searchText" => $request->searchText, "catagoryid" => $request->catagoryid]);
                } else {
                    return view("Shopkeeper.product_add_show", ["catagory" => $catagorydata, "searchText" => $request->searchText, "catagoryid" => $request->catagoryid, "dataProduct" => $data1, "showallrecord" => "yes"]);
                }
            } else {
                $data = Product::where("name", "like", "%" . $request->searchText . "%")->paginate(15);
                dd($data);
                if ($data1->total() == 0) {
                    return view("Shopkeeper.index", ["catagory" => $catagorydata, "searchText" => $request->searchText]);
                } else {
                    return view("Shopkeeper.index", ["catagory" => $catagorydata, "searchText" => $request->searchText, "dataProduct" => $data, "showallrecord" => "yes"]);
                }
            }
        }

        $data = CategoryProduct::where("category_name", $catagory)->first();
        $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();
        $data1 = Product::where("user_id", $user->id)->where('category_id', $data->id)->paginate(15);
        return view(
            "Shopkeeper.product_add_show",
            [
                "catagory" => $catagorydata,
                "catagoryid" => $data->id,
                "dataProduct" => $data1
            ]
        );
    }

    // Product Details Shopkeeper and Admin
    public function product_details($productid)
    {
        $catagorydata = CategoryProduct::all();
        $data = Product::where("id", $productid)->first();
        if (!empty(Session::get("adminname"))) {
            return view("Admin.Page.Product.productdetail", ["productdatails" => $data, "catagory" => $catagorydata,]);
        } else {

            return view("Shopkeeper.productdetail", ["productdatails" => $data, "catagory" => $catagorydata,]);
        }
    }

    // Product View Shopkeeper
    public function product_view($productid, Request $request)
    {
        $catagoryid = 0;
        $productdata = Product::where("id", $productid)->first();
        $data = CategoryProduct::where("category_name", $productdata->category->category_name)->first();

        if (!$data) {
            $catagoryid = 1;
        } else {
            $catagoryid = $data->id;
        }
        $subcatagorydata = SubCatagory::where("catagroy_id", $catagoryid)->get();

        // all catagory
        $catagory = CategoryProduct::all();

        //One Time Notification Show
        if ($productdata->admin_id != 0) {

            $cart = session()->get('onetime', []);

            if (isset($cart[$productdata->id])) {
                $cart[$productdata->id]['status'] = 1;
            } else {

                $cart[$productdata->id] = [
                    'product_id' => $productdata->id,
                    'status' => 0
                ];
            }
            session()->put('onetime', $cart);
        }

        return view("Shopkeeper.Product.viewproduct", [
            "catagory" => $catagory,
            "product_data" => $productdata,
            "subcatagory" => $subcatagorydata
        ]);
    }

    // Product Add Page
    public function Add_Product_Page($catagoryid)
    {
        $catagorydata = CategoryProduct::all();
        Session::put("categoryname", $catagoryid);
        $data = CategoryProduct::where("id", $catagoryid)->first();
        $subcatagorydata = SubCatagory::where("catagroy_id", $data->id)->get();

        return view(
            "Shopkeeper.Product.product_add",
            [
                "subcatagory" => $subcatagorydata,
                "catagory" => $catagorydata,
                "catagoryiddata" => $data
            ]
        );
    }

    // Product Delete 
    public function Product_Delete(Request $request)
    {
        $prodcut_delete = Product::find($request->id);
        if ($prodcut_delete) {
            $delete_category = $prodcut_delete->category->category_name;
            $prodcut_delete->delete();
            return redirect()->route("product.Add.Show", ["category_name" => $delete_category]);
        } else {
            return redirect()->back()->withErrors("not found data");
        }
    }
}
