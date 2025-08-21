<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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

    public function index()
    {
        return view("welcome");
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
                "email" => "required|email|unique:Customer,email",
                "phone" => "required|max:10",
                "address" => "required",
            ]);

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->password = Hash::make($request->password);
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->rols = $request->rols;
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
            $customer = Customer::where("email", $request->email)->first();

            if (empty($customer)) {
                return redirect()->back()->with("notfound", "Customer not found")->withInput();
            }

            if (!Hash::check($request->password, $customer->password)) {
                return redirect()->back()->with("passworderror", "The password is Invalid password")->withInput();
            }

            if ($request->rols == "Customer") {
                return redirect()->route("customerdashboard");
            } else {
                return redirect()->route("customerdashboard");
            }
        }
        return view("login");
    }

    public function logout(Request $request)
    {
        Session::put("loginid", "null");
        return redirect()->route("customerlogin");
    }
}
