<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\CustomerAndShopkeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

            Session::put("adminname", $admin->name);
            return redirect()->route("admindashboard");
        }
        return view('Admin.login');
    }

    public function logout(Request $request)
    {
        Session::forget('adminname');
        return redirect()->route('adminlogin');
    }
}
