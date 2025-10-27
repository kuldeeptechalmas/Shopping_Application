<?php

namespace App\Http\Controllers;

use App\Mail\welcomeEmail;
use App\Models\Admin;
use App\Models\CategoryProduct;
use App\Models\Customer;
use App\Models\CustomerAndShopkeeper;
use App\Models\CustomerOrder;
use App\Models\Images;
use App\Models\Product;
use App\Models\SubCatagory;
use FFI\Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

use function Laravel\Prompts\error;

class AdminController extends Controller
{

    // Customer And Shopkeeper Manage
    public function CustomerAndShopkeeper_Manage(Request $request)
    {
        if ($request->isMethod("post")) {

            // Search Data
            if ($request->action == "searchDataAdmin") {
                $customerandshopkeeper = CustomerAndShopkeeper::where("name", "like", "%" . $request->searchData . "%")->paginate(15);
                return view("Admin.Page.User.usershow", ["data" => $customerandshopkeeper, "searchData" => $request->searchData]);
            }

            // Remove customer and shopkeeper
            if ($request->action == "remove") {
                $userRemove = CustomerAndShopkeeper::where("id", $request->id)->first();
                if ($userRemove) {
                    $userRemove->delete();
                    return redirect()->route("admindashboard");
                }
            }
        }

        $customerandshopkeeper = CustomerAndShopkeeper::paginate(15);
        return view("Admin.Page.User.usershow", ["data" => $customerandshopkeeper]);
    }

    // Customer and shopkeeper Edit
    public function CustomerAndShopkeeper_Update(Request $request, $userId)
    {
        $success = null;
        if ($request->isMethod("post")) {
            //Edit customer ans shopkeeper

            $validator = Validator::make($request->all(), [
                "name" => "required",
                'email' => [
                    'required',
                    'email',
                    Rule::unique('CustomerAndShopkeeper', 'email')->ignore($request->id),
                ],
                "phone" => [
                    'required',
                    'numeric',
                    "digits:10",
                    Rule::unique('CustomerAndShopkeeper', 'phone')->ignore($request->id),
                ],
                "address" => "required",
                "city" => "required",
                "state" => "required",
                "country" => "required",
                "pincode" => "required|numeric|digits:6",
                "gender" => "required",
            ], [
                "name.required" => "Enter Name is Required.",
                "email.required" => "Enter email is Required.",
                "phone.required" => "Enter phone is Required.",
                "address.required" => "Enter address is Required.",
                "city.required" => "Enter city is Required.",
                "country.required" => "Enter country is Required.",
                "pincode.required" => "Enter pincode is Required.",
                "gender.required" => "Enter gender is Required.",
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $customer = CustomerAndShopkeeper::where("email", $request->email)->first();
            $customer->update([
                "name" => $request->name,
                "address" => $request->address,
                "email" => $request->email,
                "phone" => $request->phone,
                "city" => $request->city,
                "state" => $request->state,
                "country" => $request->country,
                "pincode" => $request->pincode,
                "gender" => $request->gender,
            ]);

            $success = "";
        }

        // Edit customer and shopkeeper data get
        $userEdit = CustomerAndShopkeeper::where("id", $userId)->first();
        if ($userEdit) {

            // contry data
            $content = File::get(public_path('countries.json'));
            $contryList = json_decode($content, true);

            return view("Admin.Page.User.useredit", ["save" => $success, "usereditdata" => $userEdit, "country" => $contryList]);
        }
    }

    // Product Manage
    public function Product_Manage(Request $request)
    {
        if ($request->isMethod("post")) {

            // Search Data
            if ($request->action == "searchDataAdmin") {
                $productData = Product::where("name", "like", "%" . $request->searchData . "%")->paginate(15);
                return view("Admin.Page.Product.productshow", ["data" => $productData, "searchData" => $request->searchData]);
            }

            // Remove porduct
            if ($request->action == "remove") {
                // dd($request->id);
                $productData = Product::where("id", $request->id)->first();
                if ($productData) {
                    $productData->delete();
                }
                return redirect()->route("product.manage");
            }
        }

        $product = Product::paginate(15);
        return view("Admin.Page.Product.productshow", ["data" => $product]);
    }

    // Product Edit
    public function Product_Update(Request $request, $productId)
    {
        $success = null;
        if ($request->isMethod("post")) {
            // Edit product info

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
                    "discount" => "required",
                ],
                [
                    "name.required" => "Enter Name Are Required.",
                    "name.not_regex" => "Not Enter Number only Required.",
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
                    "discount.required" => "Enter Discount Are Required.",
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $product = Product::find($request->id);
            $admin = Admin::where("name",  Session::get("adminname"))->first();

            $product->update([
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "stock" => $request->stock,
                "status" => $request->status,
                "sub_category_id" => $request->catagory,
                "discount" => $request->discount,
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

            if ($product->images->count() == 0) {
                $image = new Images();
                $image->image_name = "default_image.png";
                $image->product_id = $product->id;
                $image->save();
            }

            $success = "";
        }
        // Edit product data get
        $productData = Product::where("id", $productId)->first();

        $SubCategoryData = SubCatagory::where("catagroy_id", $productData->category->id)->get();

        if ($productData) {
            return view("Admin.Page.Product.productedit", ["save" => $success, "productData" => $productData, "subCategoryData" => $SubCategoryData]);
        }
    }

    // Order Manage
    public function Order_Manage(Request $request)
    {
        if ($request->isMethod("post")) {

            // Search Data
            if ($request->action == "searchDataAdmin") {
                $search = $request->searchData;
                $orderData = CustomerOrder::whereHas('product', function ($query) use ($search) {
                    $query->where('name', "like", "%" . $search . "%");
                })->orWhere("name", "like", "%" . $request->searchData . "%")->paginate(15);

                return view("Admin.Page.Order.ordershow", ["order" => $orderData, "searchData" => $request->searchData]);
            }

            // Display order detail
            if ($request->action == "view") {

                $orderData = CustomerOrder::find($request->id);
                if ($orderData) {
                    return view("Admin.Page.Order.orderedit", ["orderData" => $orderData]);
                }
            }

            // Delete order
            if ($request->action == "removeorder") {
                $orderData = CustomerOrder::find($request->id);
                if ($orderData) {
                    $orderData->delete();
                }
                return redirect()->back();
            }
        }
        $order = CustomerOrder::paginate(15);
        return view("Admin.Page.Order.ordershow", ["order" => $order]);
    }

    // Admin Product Detail show
    public function Admin_Product_Detail($productid)
    {
        $data = Product::where("id", $productid)->first();
        if ($data) {
            return view("Admin.Page.Product.productdetail", ["productdatails" => $data]);
        } else {
            return error("not found data");
        }
    }

    // Admin profile manage
    public function Admin_Profile_Manage(Request $request)
    {
        $success = null;
        if ($request->isMethod("post")) {
            if ($request->action == "editOrderData") {

                $validator = Validator::make($request->all(), [
                    "name" =>  [
                        'required',
                        'regex:/^[a-zA-Z0-9\s]+$/',
                        'not_regex:/^\d+$/',
                    ],
                    "conformpassword" => [
                        "required",
                        "same:password",
                        Password::min(8)->mixedCase()->symbols()->numbers()
                    ],
                    "password" => [
                        "required",
                        Password::min(8)->mixedCase()->symbols()->numbers()
                    ],
                    'email' => [
                        'required',
                        'email:rfc,dns',
                        Rule::unique('CustomerAndShopkeeper', 'id')->ignore($request->id),
                    ]
                ], [
                    "name.not_regex" => "Name Not only Numeric Required.",
                    "name.required" => "Enter Admin Name is Required.",
                    "conformpassword.required" => "Enter ConfPassword is Required.",
                    "conformpassword.min" => "Enter Min 8 Charecter is Required.",
                    "conformpassword.symbols" => "Enter Symbols is Required.",
                    "conformpassword.numbers" => "Enter Numbers is Required.",
                    "password.required" => "Enter Password is Required.",
                    "password.min" => "Enter Min 8 Charecter is Required.",
                    "password.symbols" => "Enter Symbols is Required.",
                    "password.numbers" => "Enter Numbers is Required.",
                    "email.required" => "Enter Admin Email is Required.",
                    'email.email' => 'Enter Email Must Be A Valid Email Address.',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $Admin = Admin::find($request->id);

                if (!$Admin) {
                    return redirect()->back()->withErrors(['error' => 'User not found.']);
                }

                $Admin->update([
                    "name" => $request->name,
                    "password" => $request->password,
                    "email" => $request->email,
                ]);
                $success = "";

                Session::put("adminname", $Admin->name);
            }
        }

        if (Session::get('adminname')) {
            $admin_profile = Admin::where('name', Session::get('adminname'))->first();
            return view('Admin.Page.AdminProfile.adminprofile', ["save" => $success, 'admin_profile' => $admin_profile]);
        }
    }

    // Admin logout
    public function Admin_Logout()
    {
        Session::forget('adminname');
        return redirect()->route('login');
    }

    // Search Data Product User Order
    public function Search_Data_Product_User_Order($searchData, $tableName)
    {
        if ($tableName == "User") {
            $userData = CustomerAndShopkeeper::where("name", "like", "%" . $searchData . "%")->get();
            return Response()->json([$userData]);
        }
    }

    // Admin Product Rating Table
    public function Admin_Product_Rating(Request $request)
    {
        // Search Data 
        if ($request->action == 'searchDataAdmin') {
            $Product_data_Search = Product::whereHas('rates', function ($query) {
                $query->where('rate', '>', 0);
            })->where('name', 'like', "%" . $request->searchData . "%")
                ->paginate(15);
            return view("Admin.Page.ProductRating.showproductrating", ['data' => $Product_data_Search, "searchData" => $request->searchData]);
        }

        $Product_data = Product::whereHas('rates', function ($query) {
            $query->where('rate', '>', 0);
        })->paginate(15);
        if ($Product_data) {
            return view("Admin.Page.ProductRating.showproductrating", ['data' => $Product_data]);
        } else {
            return error("not data found");
        }
    }
}
