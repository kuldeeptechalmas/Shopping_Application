<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Admin;
use App\Models\CategoryProduct;
use App\Models\Customer;
use App\Models\CustomerAndShopkeeper;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{

    // get state data of customer and shopkeeper
    public function getstate(Request $request)
    {
        $contentstate = File::get(public_path('state.json'));
        $statelist = json_decode($contentstate, true);
        $countryId = $request->data;

        $filterstate = array_filter($statelist, function ($item) use ($countryId) {
            return $item["countryId"] === $countryId;
        });
        return response()->json(["statelist" => $filterstate]);
    }

    public function getcountry(Request $request)
    {
        $contentcountry = File::get(public_path('countries.json'));
        $countrylist = json_decode($contentcountry, true);

        return response()->json(["countrylist" => $countrylist]);
    }

    public function getcity(Request $request)
    {
        $contentcity = File::get(public_path('city.json'));
        $citylist = json_decode($contentcity, true);
        $stateId = $request->data;

        // dd($citylist);

        $filtercity = array_filter($citylist, function ($item) use ($stateId) {
            return $item["stateId"] === $stateId;
        });

        return response()->json(["citylist" => $filtercity]);
    }

    public function customer_profile()
    {
        // contry data
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);

        // profile user
        $customer_profile = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
        $customer_profile->password = Crypt::decryptString($customer_profile->password);

        return view("Customer.customerprofile", ["contrylist" => $contrylist, "customer_profile" => $customer_profile]);
    }

    public function customer_change_password($customer_email, Request $request)
    {
        // profile user
        $customer_profile = CustomerAndShopkeeper::where("email", $customer_email)->first();
        $customer_profile->password = Crypt::decryptString($customer_profile->password);

        if ($request->isMethod("post")) {
            $validator = Validator::make(
                $request->all(),
                [

                    "oldpassword" => "required",
                    "newpassword" => [
                        "required",
                        Password::min(8)->mixedCase()->symbols()->numbers()
                    ],
                    "confpassword" => [
                        "required",
                        "same:newpassword",
                    ],
                ],
                [
                    "oldpassword.required" => "The old password is required.",
                    "newpassword.required" => "The new password is required.",
                    "newpassword.min" => "The new password must be at least 8 characters.",
                    "newpassword.symbols" => "The new password must contain at least one symbol.",
                    "newpassword.numbers" => "The new password must contain at least one number.",
                    "newpassword.mixedCase" => "The new password must contain at least one uppercase and one lowercase letter.",
                    "confpassword.required" => "The conform password is required.",
                    "confpassword.same" => "The password confirmation does not match.",

                ]
            );
            //             $validator = Validator::make(
            //     $request->all(),
            //     [
            //         "oldpassword" => "required",
            //         "newpassword" => [
            //             "required",
            //             "confirmed",
            //             Password::min(8)
            //                 ->mixedCase()
            //                 ->symbols()
            //                 ->numbers()
            //         ],
            //     ],
            //     [
            //         "oldpassword.required" => "The old password is required.",
            //         "newpassword.required" => "The new password is required.",
            //         "newpassword.min" => "The new password must be at least 8 characters.",
            //         "newpassword.symbols" => "The new password must contain at least one symbol.",
            //         "newpassword.numbers" => "The new password must contain at least one number.",
            //         "newpassword.mixedCase" => "The new password must contain at least one uppercase and one lowercase letter.",
            //         "newpassword.confirmed" => "The password confirmation does not match.",
            //     ]
            // );

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $customerdata = CustomerAndShopkeeper::where("email", $customer_email)->first();
            if (Crypt::decryptString($customerdata->password) == $request->oldpassword) {
                $customerdata->password = Crypt::encryptString($request->confpassword);
                $customerdata->save();
            } else {
                return back()->withInput()->with(["passworderror" => "Enter Currect Old Password"]);
            }
            return view("Customer.changepassword", ["successupdate" => "yes", "shopkeeper_data" => $customer_profile]);
        }
        return view("Customer.changepassword", ["shopkeeper_data" => $customer_profile]);
    }

    public function logout(Request $request)
    {
        if (Session::get("customerid")) {
            Session::forget("customerid");
            Session::forget("customeremail");
        }
        if (Session::get("shopkeeperid")) {
            Session::forget("shopkeeperid");
            Session::forget("shopkeeperemail");
            Session::forget("onetime");
        }
        return redirect()->route("MainIndex");
    }

    public function view_profile($email)
    {
        // contry data
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);

        $data = CustomerAndShopkeeper::where("email", $email)->first();
        return view("Shopkeeper.Profile.viewuserprofile", ["data" => $data, "contrylist" => $contrylist]);
    }

    public function Customer_Update(Request $request)
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

        $customer = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

        $customer->update([
            "name" => $request->name,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email,
            "city" => $request->city,
            "state" => $request->state,
            "country" => $request->country,
            "pincode" => $request->pincode,
            "gender" => $request->gender,
        ]);

        Session::put("customeremail", $customer->email);

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('Customer.Profile')
        ]);
    }
}
