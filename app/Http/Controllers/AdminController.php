<?php

namespace App\Http\Controllers;

use App\Mail\welcomeEmail;
use App\Models\Admin;
use App\Models\CategoryProduct;
use App\Models\Customer;
use App\Models\CustomerAndShopkeeper;
use App\Models\Product;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function dashboard()
    {
        $catagory = CategoryProduct::all();
        return view("Admin.index",["catagory"=> $catagory]);
    }

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

    public function logout(Request $request)
    {
        Session::forget('adminname');
        return redirect()->route('customerlogin');
    }

    public function updateuser(Request $request)
    {

        $request->validate([
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
            ]
        ]);

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

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('admindashboard')
        ]);
    }

    public function profileuser(Request $request)
    {
        $data = Admin::where("name", $request->adminname)->get();
        return response()->json($data);
    }

    public function deleterecord(Request $request)
    {
        $delete = CustomerAndShopkeeper::where("email", $request->email)->delete();
        return response()->json(["data" => "delete"]);
    }

    public function admin_getuserofall(Request $request)
    {
        return view("Admin.Table.usershow");
    }
    public function getuserofall(Request $request)
    {
        $data = CustomerAndShopkeeper::paginate(10);
        foreach ($data as $key) {
            $key->password = Crypt::decryptString($key->password);
        }
        if ($request->ajax()) {
            return view("Admin.Table.usertable", ["data" => $data]);
        }
        return view("Admin.Table.usertable", ["data" => $data]);
    }

    public function viewupdateuser(Request $request)
    {
        $validator = $request->validate([
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
        ],[
            "name.required" => "Enter Name is Required.",
            'email.required' => "Enter Email is Required.",
            'email.email' => "Enter Only Email is Required.",
            "phone.required" => "Enter Phone No. is Required.",
            "phone.numeric" => "Enter Only Numeric is Required.",
            "phone.digits" => "Enter 10 Digits is Required.",
            "address.required" => "Enter Address is Required.",
            "city.required" => "Enter City is Required.",
            "state.required" => "Enter State is Required.",
            "country.required" => "Enter Country is Required.",
            "pincode.required" => "Enter Pincode is Required.",
            "pincode.numeric" => "Enter Only Numeric is Required.",
            "pincode.digits" => "Enter 6 Digits is Required.",
            "gender.required" => "Enter Name is Required.",
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

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function product_details($productid)
    {
        $catagorydata = CategoryProduct::all();
        $data = Product::where("id", $productid)->first();
        return view("Admin.productdetail", ["productdatails" => $data, "catagory" => $catagorydata,]);
    }
}
