<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ShopkeeperController extends Controller
{
    public function dashboard()
    {
        $catagory = CategoryProduct::all();
        // return view("Admin.index",["catagory"=> $catagory]);
        return view("Shopkeeper.index", ["catagory" => $catagory, "showallrecord" => "yes"]);
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
        ]);

        $customer = CustomerAndShopkeeper::where("email", $request->email)->first();

        $customer->update([
            "name" => $request->name,
            "address" => $request->address,
            "password" => Crypt::encryptString($request->password),
            "email" => $request->email,
            "phone" => $request->phone,
            "city" => $request->city,
            "state" => $request->state,
            "country" => $request->country,
            "pincode" => $request->pincode,
            "gender" => $request->gender,
        ]);

        Session::put("shopkeeperid", $customer->name);

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('shopkeeperdashboard')
        ]);
    }

    public function shopkeeper_profile($shopkeeper_email)
    {
        // contry data
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);

        // profile user
        $shopkeeper_profile = CustomerAndShopkeeper::where("email", $shopkeeper_email)->first();
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
                "oldpassword" => "required",
                "newpassword" => "required",
                "confpassword" => "required|same:newpassword",
            ], [
                "oldpassword.required" => "Enter Old Password are Required",
                "newpassword.required" => "Enter New Password are Required",
                "confpassword.required" => "Enter Conform Password are Required",
                "confpassword.same" => "Enter Password are Not Match to New Password",
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

    public function shopkeeper_forget_password(Request $request)
    {
        if ($request->isMethod("post")) {

            $request->validate([
                "newpassword" => "required",
                "confpassword" => "required|same:newpassword",
            ], [
                "newpassword.required" => "Enter New Password are Required",
                "confpassword.required" => "Enter Conform Password are Required",
                "confpassword.same" => "Enter Password are Not Match to New Password",
            ]);
            $shopkeeperdata = CustomerAndShopkeeper::where("email", Session::get("emailforgotpassword"))->first();
            $shopkeeperdata->password=Crypt::encryptString($request->confpassword);
            $shopkeeperdata->save();

            return redirect()->route("customerlogin");
        }
        return view("ForgetPassword.forgotpassword",["notshowemail"=>"yes"]);
    }

    public function forget_password(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->validate([
                "email" => "required|email"
            ], [
                "email.required" => "Enter Email is Required",
                "email.email" => "Enter Only Email is Required"
            ]);

            $shopkeeperdata = CustomerAndShopkeeper::where("email", $request->email)->first();
            if ($shopkeeperdata) {
                Session::put("emailforgotpassword",$shopkeeperdata->email);
                return redirect()->route("forgetpassword");
            } else {
                return back()->withInput()->with(["emailerror" => "Enter Email is Not Exist !"]);
            }
        }
        return view("ForgetPassword.emailvarify");
    }

    public function view_profile($email){

        // contry data
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);

        $data=CustomerAndShopkeeper::where("email",$email)->first();
        return view("Shopkeeper.Profile.viewuserprofile",["data"=>$data,"contrylist" => $contrylist]);
    }
}
