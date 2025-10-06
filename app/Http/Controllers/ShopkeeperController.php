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
    public function dashboard(Request $request)
    {

        $catagory = CategoryProduct::all();
        if ($request->isMethod("post")) {

            // Search Product
            $user = CustomerAndShopkeeper::where("email", Session::get("shopkeeperemail"))->first();

            if (isset($request->catagoryid)) {
                $data1 = Product::where("user_id", $user->id)->where("category_id", $request->catagoryid)->where("name", "like", "%" . $request->searchText . "%")->paginate(15);
                if ($data1->count() == 0) {
                    return view("Shopkeeper.product_add_show", ["catagory" => $catagory, "searchText" => $request->searchText]);
                } else {
                    return view("Shopkeeper.product_add_show", ["catagory" => $catagory, "searchText" => $request->searchText, "catagoryid" => $request->catagoryid, "data" => $data1, "showallrecord" => "yes"]);
                }
            } else {

                $data = Product::where("name", "like", "%" . $request->searchText . "%")->where("user_id", $user->id)->paginate(15);

                if ($data->count() == 0) {
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
        // return view("Shopkeeper.index", ["catagory" => $catagory, ]);
    }
    public function profileuser(Request $request)
    {
        $data = CustomerAndShopkeeper::where("email", $request->shopkeeperemail)->first();
        $data->password = Crypt::decryptString($data->password);
        return response()->json($data);
    }
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
                "digits:10",
                Rule::unique('CustomerAndShopkeeper', 'phone')->ignore($request->id),
            ],
            "email" => [
                "required",
                "email:rfc,dns",
                Rule::unique('CustomerAndShopkeeper', 'email')->ignore($request->id),
            ],
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "country" => "required",
            "pincode" => "required|numeric|digits:6",
            "gender" => "required",
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

        Session::put("shopkeeperid", $customer->name);
        Session::put("shopkeeperemail", $customer->email);

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('Shopkeeper.Profile')
        ]);
    }

    public function shopkeeper_profile()
    {
        // contry data
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);

        // profile user
        $shopkeeper_profile = CustomerAndShopkeeper::where("email", Session::get('shopkeeperemail'))->first();
        $shopkeeper_profile->password = Crypt::decryptString($shopkeeper_profile->password);

        // all catagory
        $catagory = CategoryProduct::all();

        return view("Shopkeeper.Profile.shopkeeperprofile", ["catagory" => $catagory, "contrylist" => $contrylist, "shopkeeper_profile" => $shopkeeper_profile]);
    }

    public function shopkeeper_change_password($shopkeeper_email, Request $request)
    {
        // all catagory
        $catagory = CategoryProduct::all();

        // profile user
        $shopkeeper_profile = CustomerAndShopkeeper::where("email", $shopkeeper_email)->first();
        $shopkeeper_profile->password = Crypt::decryptString($shopkeeper_profile->password);

        if ($request->isMethod("post")) {
            $request->validate([

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
                "oldpassword" => "required",
                // "newpassword" => "required",
                // "confpassword" => "required|same:newpassword",
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

    public function view_profile($email)
    {
        // contry data
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);

        $data = CustomerAndShopkeeper::where("email", $email)->first();
        return view("Shopkeeper.Profile.viewuserprofile", ["data" => $data, "contrylist" => $contrylist]);
    }

    public function Shopkeeper_Order_List(Request $request)
    {
        if ($request->isMethod("post")) {

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
        return view("Shopkeeper.Order.orderlist", ['order_Data' => $paginatedata]);
    }

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
