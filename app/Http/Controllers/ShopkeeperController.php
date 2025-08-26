<?php

namespace App\Http\Controllers;

use App\Models\CustomerAndShopkeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ShopkeeperController extends Controller
{
    public function dashboard()
    {
        $content = File::get(public_path('countries.json'));
        $contrylist = json_decode($content, true);
        return view("Shopkeeper.index", compact("contrylist"));
    }
    public function profileuser(Request $request)
    {
        $data = CustomerAndShopkeeper::where("email", $request->shopkeeperemail)->first();
        $data->password= Crypt::decryptString($data->password);
        return response()->json($data);
    }

    public function updateuser(Request $request)
    {
        $request->validate([
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

        Session::put("shopkeeperid", $customer->name);

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('shopkeeperdashboard')
        ]);
    }

}
