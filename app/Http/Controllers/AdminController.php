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
use FFI\Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

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
            elseif ($request->action == "remove") {
                $userRemove = CustomerAndShopkeeper::where("id", $request->id)->first();
                if ($userRemove) {
                    $userRemove->delete();
                    return redirect()->back();
                }
            }
        }

        $customerandshopkeeper = CustomerAndShopkeeper::paginate(15);
        return view("Admin.Page.User.usershow", ["data" => $customerandshopkeeper]);
    }

    // Customer and shopkeeper Edit
    public function CustomerAndShopkeeper_Update(Request $request, $userId)
    {
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
            return redirect()->back();
        }

        // Edit customer and shopkeeper data get
        $userEdit = CustomerAndShopkeeper::where("id", $userId)->first();
        if ($userEdit) {

            // contry data
            $content = File::get(public_path('countries.json'));
            $contryList = json_decode($content, true);

            return view("Admin.Page.User.useredit", ["usereditdata" => $userEdit, "country" => $contryList]);
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
                return redirect()->back();
            }
        }

        $product = Product::paginate(15);
        return view("Admin.Page.Product.productshow", ["data" => $product]);
    }

    // Product Edit
    public function Product_Update(Request $request, $productId)
    {
        if ($request->isMethod("post")) {
            // Edit product info

            $validator = Validator::make(
                $request->all(),
                [
                    "name" => "required",
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
        }
        // Edit product data get
        $productData = Product::where("id", $productId)->first();
        if ($productData) {
            return view("Admin.Page.Product.productedit", ["productData" => $productData]);
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

            // Edit order data
            if ($request->action == "editOrderData") {
                $validator = Validator::make($request->all(), [
                    "status" => "required"
                ], [
                    "status.required" => "Select Status of Order Product."
                ]);

                if ($validator->fails()) {
                    $orderData = CustomerOrder::find($request->id);
                    if ($orderData) {
                        return view("Admin.Page.Order.orderedit", ["validator" => $validator, "orderData" => $orderData]);
                    }
                }

                $orderData = CustomerOrder::find($request->id);
                if ($orderData) {
                    $orderData->status = $request->status;
                    $orderData->save();
                }
            }
        }
        $order = CustomerOrder::paginate(15);
        return view("Admin.Page.Order.ordershow", ["order" => $order]);
    }

    // Admin Product Detail show
    public function Admin_Product_Detail($productid)
    {
        $data = Product::where("id", $productid)->first();
        return view("Admin.Page.Product.productdetail", ["productdatails" => $data]);
    }

    // Admin profile manage
    public function Admin_Profile_Manage(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->action == "editOrderData") {

                $validator = Validator::make($request->all(), [
                    "name" => "required",
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
                    'email.email' => 'The email you provided is not valid.',
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

                Session::put("adminname", $Admin->name);
            }
        }

        if (Session::get('adminname')) {
            $admin_profile = Admin::where('name', Session::get('adminname'))->first();
            return view('Admin.Page.AdminProfile.adminprofile', ['admin_profile' => $admin_profile]);
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

    // public function dashboard()
    // {
    //     // return redirect()->route("admin_get_user_of_all");
    // }

    // public function login(Request $request)
    // {
    //     if ($request->isMethod("post")) {
    //         $validator = $request->validate([
    //             "email" => "required",
    //             "password" => "required",
    //         ],[
    //             "email.required" => "Enter Email is Required.",
    //             "password.required" => "Enter Password is Required.",
    //         ]);

    //         $admin = Admin::where("email", $request->email)->first();

    //         if (empty($admin)) {
    //             return redirect()->back()->with("error", "Admin not found");
    //         }


    //         return redirect()->route("admindashboard");
    //     }
    //     return view('Admin.login');
    // }

    // public function logout(Request $request)
    // {
    //     Session::forget('adminname');
    //     return redirect()->route('customerlogin');
    // }

    // public function updateuser(Request $request)
    // {

    //     $request->validate([
    //         "name" => "required",
    //         "conformpassword" => [
    //             "required",
    //             "same:password",
    //             Password::min(8)->mixedCase()->symbols()->numbers()
    //         ],
    //         "password" => [
    //             "required",
    //             Password::min(8)->mixedCase()->symbols()->numbers()
    //         ],
    //         'email' => [
    //             'required',
    //             'email',
    //             Rule::unique('CustomerAndShopkeeper', 'email')->ignore($request->id),
    //         ]
    //     ]);

    //     $Admin = Admin::find($request->id);

    //     if (!$Admin) {
    //         return redirect()->back()->withErrors(['error' => 'User not found.']);
    //     }

    //     $Admin->update([
    //         "name" => $request->name,
    //         "password" => $request->password,
    //         "email" => $request->email,
    //     ]);


    //     Session::put("adminname", $Admin->name);

    //     return response()->json([
    //         'status' => 'success',
    //         'redirect_url' => route('admindashboard')
    //     ]);
    // }

    // public function profileuser(Request $request)
    // {
    //     $data = Admin::where("name", $request->adminname)->get();
    //     return response()->json($data);
    // }

    // public function deleterecord(Request $request)
    // {
    //     $delete = CustomerAndShopkeeper::where("email", $request->email)->first();
    //     if ($delete) {
    //         $delete->delete();
    //     } else {
    //         return response()->withCookie(["erroradmin" => "User Not Found"]);
    //     }
    //     return redirect()->route("admin_get_user_of_all");
    // }

    // public function admin_getuserofall(Request $request)
    // {
    //     return view("Admin.Table.usershow");
    // }

    // public function getuserofall(Request $request)
    // {
    //     $data = CustomerAndShopkeeper::paginate(9);
    //     foreach ($data as $key) {
    //         $key->password = Crypt::decryptString($key->password);
    //     }
    //     if ($request->ajax()) {
    //         return view("Admin.Table.usertable", ["data" => $data]);
    //     }
    //     return view("Admin.Table.usertable", ["data" => $data]);
    // }

    // public function viewupdateuser(Request $request)
    // {
    //     $validator = $request->validate([
    //         "name" => "required",
    //         'email' => [
    //             'required',
    //             'email',
    //             Rule::unique('CustomerAndShopkeeper', 'email')->ignore($request->id),
    //         ],
    //         "phone" => [
    //             'required',
    //             'numeric',
    //             "digits:10",
    //             Rule::unique('CustomerAndShopkeeper', 'phone')->ignore($request->id),
    //         ],
    //         "address" => "required",
    //         "city" => "required",
    //         "state" => "required",
    //         "country" => "required",
    //         "pincode" => "required|numeric|digits:6",
    //         "gender" => "required",
    //     ], [
    //         "name.required" => "Enter Name is Required.",
    //         'email.required' => "Enter Email is Required.",
    //         'email.email' => "Enter Only Email is Required.",
    //         "phone.required" => "Enter Phone No. is Required.",
    //         "phone.numeric" => "Enter Only Numeric is Required.",
    //         "phone.digits" => "Enter 10 Digits is Required.",
    //         "address.required" => "Enter Address is Required.",
    //         "city.required" => "Enter City is Required.",
    //         "state.required" => "Enter State is Required.",
    //         "country.required" => "Enter Country is Required.",
    //         "pincode.required" => "Enter Pincode is Required.",
    //         "pincode.numeric" => "Enter Only Numeric is Required.",
    //         "pincode.digits" => "Enter 6 Digits is Required.",
    //         "gender.required" => "Enter Name is Required.",
    //     ]);

    //     $customer = CustomerAndShopkeeper::where("email", $request->email)->first();

    //     $customer->update([
    //         "name" => $request->name,
    //         "address" => $request->address,
    //         "password" => Crypt::encryptString($request->password),
    //         "email" => $request->email,
    //         "phone" => $request->phone,
    //         "city" => $request->city,
    //         "state" => $request->state,
    //         "country" => $request->country,
    //         "pincode" => $request->pincode,
    //         "gender" => $request->gender,
    //     ]);

    //     return redirect()->back();
    // }

    // public function product_details($productid)
    // {
    //     $catagorydata = CategoryProduct::all();
    //     $data = Product::where("id", $productid)->first();
    //     return view("Admin.productdetail", ["productdatails" => $data, "catagory" => $catagorydata,]);
    // }

    // public function  view_all_order()
    // {
    //     $data = CustomerOrder::paginate(10);
    //     return view("Admin.ViewOrder.viewallorder", ["data" => $data]);
    // }
    // public function  view_order($orderid)
    // {
    //     $data = CustomerOrder::find($orderid);
    //     return view("Admin.ViewOrder.vieworderdetail", ["order" => $data]);
    // }

    // public function update_order_admin(Request $request)
    // {
    //     $order = CustomerOrder::find($request->orderid);
    //     if ($order) {
    //         $order->status = $request->status;
    //         $order->save();
    //     }
    //     return redirect()->route("viewallorder");
    // }

    // public function get_user_admin($id)
    // {
    //     // contry data
    //     $content = File::get(public_path('countries.json'));
    //     $contrylist = json_decode($content, true);

    //     $product_data = CustomerAndShopkeeper::find($id);
    //     if ($product_data) {
    //         return view("Admin.ViewPage.userview", ["data" => $product_data, "country" => $contrylist]);
    //     } else {
    //         return redirect()->back();
    //     }
    // }
}
