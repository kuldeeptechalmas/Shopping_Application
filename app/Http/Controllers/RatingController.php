<?php

namespace App\Http\Controllers;

use App\Models\CustomerAndShopkeeper;
use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RatingController extends Controller
{
    public function Order_Rating_Store(Request $request)
    {
        $Currenct_User = CustomerAndShopkeeper::where("email", Session::get('customeremail'))->first();

        if ($Currenct_User) {
            $Rate_Product = new Rating();
            $Rate_Product->rate = $request->rate;
            $Rate_Product->product_id = $request->product_id;
            $Rate_Product->user_id = $Currenct_User->id;
            $Rate_Product->save();

            // dd()

            $Customer_Order = CustomerOrder::where("product_id", $request->product_id)->where('email', $Currenct_User->email)->first();
            $Customer_Order->rate_id = $Rate_Product->id;
            $Customer_Order->save();

            return response()->json(['save' => 'success']);
        } else {
            return response()->json(['save' => 'not']);
        }
    }
}
