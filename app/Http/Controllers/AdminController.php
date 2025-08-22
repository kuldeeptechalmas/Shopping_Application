<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\CustomerAndShopkeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function dashboard()
    {
        $customer = CustomerAndShopkeeper::where("rols","Customer")->get();
        $shopkeeper = CustomerAndShopkeeper::where("rols","Shopkeeper")->get();
        return view("Admin.index", compact("customer","shopkeeper"));
    }

    public function login(Request $request)
    {
        if($request->isMethod("post")){
            $validator = $request->validate([
                "email" => "required",
                "password" => "required",
            ]);

            $admin = Admin ::where("email", $request->email)->first();

            if(empty($admin)) {
                return redirect()->back()->with("error","Admin not found");
            }

            
            return redirect()->route("admindashboard");
        }
        return view('Admin.login');
    }

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


}
