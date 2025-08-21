<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAndShopkeeper;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    public function dashboard(Request $request)
    {
        return view("Customer.index");
    }

    public function registration(Request $request)
    {

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
                "phone" => "required|max:10",
                "address" => "required",
                "city" => "required",
                "state" => "required",
                "country" => "required",
                "pincode" => "required",
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
        return view("registration");
    }

    public function login(Request $request)
    {
        if ($request->isMethod("post")) {

            $validator = $request->validate([
                "email" => "required",
                "password" => "required",
            ]);
            $customer = CustomerAndShopkeeper::where("email", $request->email)
                ->where("rols", $request->rols)
                ->first();

            if (!empty($request->rols)) {
                if (empty($customer)) {
                    return redirect()->back()->with("notfound", $request->rols." not found")->withInput();
                }
            } 
            
            if ($request->password!=$customer->password) {
                return redirect()->back()->with("passworderror", "The password is Invalid password")->withInput();
            }

            if ($customer->rols == "Customer") {
                Session::put("loginid", $customer->name);
                return redirect()->route("customerdashboard");
            } else {
                Session::put("loginid", $customer->name);
                return redirect()->route("shopkeeperdashboard");
            }
        }
        return view("login");
    }

    public function logout(Request $request)
    {
        Session::forget("loginid", );
        return redirect()->route("customerlogin");
    }
}
