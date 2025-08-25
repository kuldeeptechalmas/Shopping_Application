<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\CustomerAndShopkeeper;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    public function dashboard(Request $request)
    {
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);
        // $contrylists = json_encode($contrylist, true);
        return view("Customer.index",compact("contrylist"));
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
                "phone" => "required|numeric|digits:10",
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
            $customer->password = $request->password;
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
        return view("registration",compact("contrylist"));
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
            if (!empty($customer->rols)) {
                if (empty($customer)) {
                    return redirect()->back()->with("notfound", $customer->rols . " not found")->withInput();
                }
            }

            if ($request->password != $customer->password) {
                return redirect()->back()->with("passworderror", "The password is Invalid password")->withInput();
            }

            if ($customer->rols == "Customer") {
                Session::put("customerid", $customer->name);
                return redirect()->route("customerdashboard");
            } else {
                Session::put("shopkeeperid", $customer->name);
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

        dd($request->all());    

        $responce = $request->validate([
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
                'email',
                Rule::unique('CustomerAndShopkeeper', 'email')->ignore($request->id),
            ],
            "phone" => "required|max:10",
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "country" => "required",
            "pincode" => "required|max:6",
            "gender" => "required",
        ]);


        $customer = CustomerAndShopkeeper::where("email", $request->email)->first();
        $customer->update([
            "name" => $request->name,
            "address" => $request->address,
            "password" => $request->password,
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
        $data = CustomerAndShopkeeper::where("name", $request->customerid)->get();
        return response()->json($data);
    }

    public function getallcustomer(Request $request)
    {
        $data = CustomerAndShopkeeper::where("rols", 'Customer')->get();
        return view("Admin.Table.customertable", ["customer" => $data]);
    }
}
