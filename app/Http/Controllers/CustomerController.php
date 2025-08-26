<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\CustomerAndShopkeeper;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    public function dashboard(Request $request)
    {
        $contentcountry = File::get(public_path('countries.json'));
        $contrylist = json_decode($contentcountry, true);

        // $contentstate = File::get(public_path('state.json'));
        // $statelist = json_decode($contentstate, true);
        
        // $contentcity = File::get(public_path('city.json'));
        // $citylist = json_decode($contentcity, true);

        // dd($statelist);
        // dd($citylist[0]);

        return view("Customer.index", ["contrylist"=>$contrylist]);
        // "statelist"=>$statelist,"citylist"=>$citylist]);
    }

    public function getstate_city(Request $request)
    {
        $contentstate = File::get(public_path('state.json'));
        $statelist = json_decode($contentstate, true);
        dd($request->all());
        // $statelistofarray =array();
        // for ($i = 0; $i < count($statelist); $i++) {
        //         if($statelist[$i][""])
        //     dd($statelist[$i]);
        // }
    }

    public function registration(Request $request)
    {

        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);

        if ($request->isMethod("post")) {

            $validator = $request->validate([
                "name" => "required",
                "conformpassword" => [
                    "required",
                    "same:password",
                    Password::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ],
                "password" => [
                    "required",
                    Password::min(8)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ],
                "email" => "required|email|unique:CustomerAndShopkeeper,email",
                "phone" => "required|numeric|digits:10|unique:CustomerAndShopkeeper,phone",
                "address" => "required",
                "city" => "required",
                "state" => "required",
                "country" => "required",
                "pincode" => "required|numeric|digits:6",
                "gender" => "required",
            ]);

            $customer = new CustomerAndShopkeeper();
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->password = Crypt::encryptString($request->password);
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->rols = $request->rols;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->country = $request->country;
            $customer->pincode = $request->pincode;
            $customer->gender = $request->gender;
            $customer->save();

            return redirect()->route("customerlogin");
        }
        return view("registration", compact("contrylist"));
    }

    public function login(Request $request)
    {
    
        if ($request->isMethod("post")) {

            $validator = $request->validate([
                "email" => "required",
                "password" => "required",
            ]);

            

            $customer = CustomerAndShopkeeper::where("email", $request->email)->first();
            $admin = Admin::where("email", $request->email)->first();
            
            if ($admin) {
                if ($request->password == $admin->password) {
                    Session::put("adminname", $admin->name);
                    return redirect()->route("admindashboard");
                } else {
                    return redirect()->back()->with("passworderror", "The password is Invalid password")->withInput();
                }
            }
            if (empty($customer)) {
                return redirect()->route("error");
            }
            
            if (!empty($customer->rols)) {
                if (empty($customer)) {
                    return redirect()->back()->with("notfound", $customer->rols . " not found")->withInput();
                }
            }
            
            if ($request->password != Crypt::decryptString($customer->password)) {
                return redirect()->back()->with("passworderror", "The password is Invalid password")->withInput();
            }
            
            if ($customer->rols == "Customer") {
                Session::put("customerid", $customer->name);
                Session::put("customeremail", $customer->email);
                return redirect()->route("customerdashboard");
            } else {
                Session::put("shopkeeperid", $customer->name);
                Session::put("shopkeeperemail", $customer->email);
                return redirect()->route("shopkeeperdashboard");
            }
        }
        return view("login");
    }

    public function logout(Request $request)
    {
        if (Session::get("customerid")) {
            Session::forget("customerid");
        }
        if (Session::get("shopkeeperid")) {
            Session::forget("shopkeeperid");
        }
        return redirect()->route("customerlogin");
    }

    public function updateuser(Request $request)
    {
        $validator = $request->validate([
            "name" => "required",
            "conformpassword" => [
                "required",
                "same:password",
                Password::min(8)
                    ->mixedCase()
                    ->symbols()
                    ->numbers()
            ],
            "password" => [
                "required",
                Password::min(8)
                    ->mixedCase()
                    ->symbols()
                    ->numbers()
            ],
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


        Session::put("customerid", $request->name);

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('customerdashboard')
        ]);
    }
    public function profileuser(Request $request)
    {
        
        $data = CustomerAndShopkeeper::where("email", $request->customeremail)->first();
        $data->password= Crypt::decryptString($data->password);
        return response()->json($data);
    }

}
