<?php

namespace App\Http\Controllers;

use App\Models\CustomerAndShopkeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ShopkeeperController extends Controller
{
    public function dashboard()
    {
        return view("Shopkeeper.index");
    }
    public function profileuser(Request $request)
    {
        $data = CustomerAndShopkeeper::where("name", $request->shopkeeperid)->get();
        return response()->json($data);
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
            ],
            "phone" => "required|max:10",
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "country" => "required",
            "pincode" => "required",
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

        Session::put("shopkeeperid", $customer->name);

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('shopkeeperdashboard')
        ]);
    }

    public function getallshopkeeper(Request $request)
    {
        
        $data=CustomerAndShopkeeper::where('rols',"Shopkeeper")->get();
        return view("Admin.Table.shopkeepertable",["shopkeeper"=> $data]);
    }
}
