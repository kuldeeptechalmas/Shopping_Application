<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\CustomerOrder;
use App\Models\Images;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ShopkeeperController extends Controller
{
    // Shopkeeper Main Page
    public function dashboard(Request $request)
    {
        $catagory = CategoryProduct::all();
        if ($request->isMethod("post")) {

            // Search Product
            $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();

            if (isset($request->catagoryid)) {
                $data1 = Product::where("user_id", $user->id)->where("category_id", $request->catagoryid)->where("name", "like", "%" . $request->searchText . "%")->paginate(15);
                if ($data1->total() == 0) {
                    return view("Shopkeeper.product_add_show", ["catagory" => $catagory, "searchText" => $request->searchText]);
                } else {
                    return view("Shopkeeper.product_add_show", ["catagory" => $catagory, "searchText" => $request->searchText, "catagoryid" => $request->catagoryid, "data" => $data1, "showallrecord" => "yes"]);
                }
            } else {

                $data = Product::where("name", "like", "%" . $request->searchText . "%")->where("user_id", $user->id)->paginate(15);
                if ($data->total() == 0) {
                    return view("Shopkeeper.index", ["catagory" => $catagory, "showallrecord" => "yes", "searchText" => $request->searchText]);
                } else {
                    return view("Shopkeeper.index", ["catagory" => $catagory, "data" => $data, "showallrecord" => "yes", "searchText" => $request->searchText]);
                }
            }
        }

        // Product Detail
        $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();
        if (isset($request->catagoryid)) {

            $data1 = Product::where("user_id", $user->id)->where("category_id", $request->catagoryid)->paginate(15);
            return view("Shopkeeper.index", ["data" => $data1]);
        } else {

            $data = Product::where("user_id", $user->id)->paginate(15);
            return view("Shopkeeper.index", ["data" => $data, "catagory" => $catagory, "showallrecord" => "yes"]);
        }
    }

    // Update Profile User
    public function updateuser(Request $request)
    {
        $request->validate([
            "name" =>  [
                'required',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'not_regex:/^\d+$/',
            ],
            "phone" => [
                'required',
                'numeric',
                "phone:countrycode",
                Rule::unique('CustomerAndShopkeeper', 'phone')->ignore($request->id),
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo)\.com$/',
                Rule::unique('CustomerAndShopkeeper', 'email')->ignore($request->id),
            ],
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "country" => "required",
            "pincode" => "required|numeric|digits:6",
            "gender" => "required",
        ], [
            "name.required" => 'Enter Name is Required.',
            "name.not_regex" => 'Enter Name Format is valid.',

            "phone.required" => 'Enter Phone is Required.',
            "phone.phone" => 'Enter Currect Phone number to ' . $request->countrycode . '.',

            "address.required" => 'Enter Address is Required.',
            "city.required" => 'Enter City is Required.',
            "state.required" => 'Enter State is Required.',
            "country.required" => 'Enter Country is Required.',
            "pincode.required" => 'Enter Pincode is Required.',
            "gender.required" => 'Enter Gender is Required.',

            'email.required' => 'Enter Email is Required.',
            'email.email' => 'Enter Email Must Be A Valid Email Address.',
            'email.regex' => 'The email must be from an allowed domain (gmail.com, yahoo.com).',
        ]);

        $customer = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();

        $customer->update([
            "name" => $request->name,
            "email" => $request->email,
            "address" => $request->address,
            "phone" => $request->phone,
            "city" => $request->city,
            "state" => $request->state,
            "country" => $request->country,
            "pincode" => $request->pincode,
            "gender" => $request->gender,
        ]);

        $customer->countrycode = $request->countrycode;
        $customer->save();

        Session::put("shopkeeperid", $customer->name);
        Session::put("shopkeeperemail", $customer->email);

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('Shopkeeper.Profile')
        ]);
    }

    // Show Shopkeeper Profile
    public function shopkeeper_profile()
    {
        // contry data
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);
        $countrycode = File::get(public_path('countryandcode.json'));
        $contrycodelist = json_decode($countrycode, true);

        // profile user
        $shopkeeper_profile = CustomerAndShopkeeper::where("email", Session::get('shopkeeperemail'))->first();
        $shopkeeper_profile->password = Crypt::decryptString($shopkeeper_profile->password);

        // all catagory
        $catagory = CategoryProduct::all();

        return view("Shopkeeper.Profile.shopkeeperprofile", ["catagory" => $catagory, "contrylist" => $contrylist, "shopkeeper_profile" => $shopkeeper_profile, 'countrycode' => $contrycodelist]);
    }

    // Change Password
    public function shopkeeper_change_password($shopkeeper_email, Request $request)
    {
        // all catagory
        $catagory = CategoryProduct::all();

        // profile user
        $shopkeeper_profile = CustomerAndShopkeeper::where("email", $shopkeeper_email)->first();
        $shopkeeper_profile->password = Crypt::decryptString($shopkeeper_profile->password);

        if ($request->isMethod("post")) {
            $request->validate([

                "oldpassword" => "required",
                "newpassword" => [
                    "required",
                    Password::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ],
                "confpassword" => [
                    "required",
                    "same:newpassword",
                    Password::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ],
            ], [
                "oldpassword.required" => "The old password is required.",

                "newpassword.required" => "The new password is required.",
                "newpassword.min" => "The new password must be at least 8 characters.",
                "newpassword.symbols" => "The new password must contain at least one symbol.",
                "newpassword.numbers" => "The new password must contain at least one number.",
                "newpassword.mixedCase" => "The new password must contain at least one uppercase and one lowercase letter.",

                "confpassword.required" => "The conform password is required.",
                "confpassword.min" => "The conform password must be at least 8 characters.",
                "confpassword.symbols" => "The conform password must contain at least one symbol.",
                "confpassword.numbers" => "The conform password must contain at least one number.",
                "confpassword.mixedCase" => "The conform password must contain at least one uppercase and one lowercase letter.",
            ]);

            $shopkeeperdata = CustomerAndShopkeeper::where("email", $shopkeeper_email)->first();
            if (Crypt::decryptString($shopkeeperdata->password) == $request->oldpassword) {
                $shopkeeperdata->password = Crypt::encryptString($request->confpassword);
                $shopkeeperdata->save();
            } else {
                return back()->withInput()->with(["passworderror" => "Enter Currect Old Password"]);
            }
            return view("Shopkeeper.Profile.changepassword", ["successupdate" => "yes", "catagory" => $catagory, "shopkeeper_data" => $shopkeeper_profile]);
        }
        return view("Shopkeeper.Profile.changepassword", ["catagory" => $catagory, "shopkeeper_data" => $shopkeeper_profile]);
    }

    // Profile Form Data Show
    public function view_profile($email)
    {
        // contry data
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);
        $countrycode = File::get(public_path('countryandcode.json'));
        $contrycodelist = json_decode($countrycode, true);

        $data = CustomerAndShopkeeper::where("email", $email)->first();

        return view("Shopkeeper.Profile.viewuserprofile", ["data" => $data, "contrylist" => $contrylist, 'countrycode' => $contrycodelist]);
    }

    // Order List
    public function Shopkeeper_Order_List(Request $request)
    {
        if ($request->isMethod("post")) {

            // Search
            if ($request->action == 'searchOrder') {

                $shopkeeper_Data = CustomerAndShopkeeper::where("email", Session::get('shopkeeperemail'))->first();
                $sid = $shopkeeper_Data->id;
                $searchData = $request->searchText;

                $paginatedata = CustomerOrder::whereHas('product', function ($query) use ($sid, $searchData) {
                    $query->where('user_id', $sid);
                    $query->where('name', "like", "%" . $searchData . "%");
                })->paginate(15);

                // all catagory
                $catagory = CategoryProduct::all();

                return view("Shopkeeper.Order.orderlist", ["searchText" => $request->searchText, "catagory" => $catagory, 'order_Data' => $paginatedata]);
            }

            // Remove data
            if ($request->action == 'removeorder') {
                $orderData = CustomerOrder::find($request->id);
                if ($orderData) {
                    $orderData->delete();
                    return redirect()->back();
                }
            }

            // view data get
            if ($request->action == 'edit') {
                $view_Order = CustomerOrder::find($request->id);
                if ($view_Order) {
                    return view("Shopkeeper.Order.orderedit", ['orderData' => $view_Order]);
                }
            }

            // edit data
            if ($request->action == 'editOrder') {

                $validator = Validator::make($request->all(), [
                    "status" => "required"
                ], [
                    "status.required" => "Select Status of Order Product."
                ]);
                if ($validator->fails()) {
                    $view_Order = CustomerOrder::find($request->id);
                    return view('Shopkeeper.Order.orderedit', ['orderData' => $view_Order, 'validator' => $validator]);
                }

                $orderData = CustomerOrder::find($request->id);
                if ($orderData) {
                    $orderData->status = $request->status;
                    $orderData->save();
                }
            }
        }

        $shopkeeper_Data = CustomerAndShopkeeper::where("email", Session::get('shopkeeperemail'))->first();
        $sid = $shopkeeper_Data->id;

        $paginatedata = CustomerOrder::whereHas('product', function ($query) use ($sid) {
            $query->where('user_id', $sid);
        })->paginate(15);

        // all catagory
        $catagory = CategoryProduct::all();

        return view("Shopkeeper.Order.orderlist", ["catagory" => $catagory, 'order_Data' => $paginatedata]);
    }

    // Remove Image To Product Admin Product and Shopkeeper Product
    public function Remove_Image_Product($imageid, $productId)
    {
        $imageData = Images::find($imageid);
        $productData = Product::find($productId);

        if ($imageData) {
            $imageData->delete();
        }

        if ($productData->images->count() == 0) {
            $image = new Images();
            $image->image_name = "default_image.png";
            $image->product_id = $productData->id;
            $image->save();
        }

        $imageDataall = Images::where("product_id", $productId)->get();
        if ($imageData->image_name == $productData->image) {
            $productData->image = $imageDataall[0]->image_name;
            $productData->save();
        }
        return redirect()->back();
    }
}
