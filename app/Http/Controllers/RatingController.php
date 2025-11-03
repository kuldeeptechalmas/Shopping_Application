<?php

namespace App\Http\Controllers;

use App\Models\CustomerAndShopkeeper;
use App\Models\Product;
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

        if (Session::get("customeremail")) {

            $Currenct_User = CustomerAndShopkeeper::where("email", Session::get('customeremail'))->first();
            // dd($Currenct_User);

            $Customer_Order = CustomerOrder::where("product_id", $request->product_id)->where('email', $Currenct_User->email)->first();

            // Order is done then given Rating
            if (isset($Customer_Order)) {

                if ($Customer_Order->rate_id == 0) {

                    $Rate_Product = new Rating();
                    $Rate_Product->rate = $request->rate;
                    $Rate_Product->product_id = $request->product_id;
                    $Rate_Product->user_id = $Currenct_User->id;
                    $Rate_Product->save();

                    $Customer_Order->rate_id = $Rate_Product->id;
                    $Customer_Order->save();

                    return response()->json(['save' => 'success']);
                } else {
                    $ExistRatingOrder = Rating::where('product_id', $request->product_id)
                        ->where('user_id', $Currenct_User->id)->first();
                    // dd($ExistRatingOrder);
                    if ($ExistRatingOrder) {
                        $ExistRatingOrder->rate = $request->rate;
                        $ExistRatingOrder->save();

                        return response()->json(['save' => 'success']);
                    }
                }
            } else {
                // Login Customer is Rating to Product

                $Rating_Product_Exist = Rating::where("product_id", $request->product_id)
                    ->where("user_id", $Currenct_User->id)
                    ->first();

                if (!isset($Rating_Product_Exist)) {
                    $Rate_Product = new Rating();
                    $Rate_Product->rate = $request->rate;
                    $Rate_Product->product_id = $request->product_id;
                    $Rate_Product->user_id = $Currenct_User->id;
                    $Rate_Product->save();

                    $Rating_Product_Data = Product::find($request->product_id);

                    // Rating Counte
                    $rateConversion = 0;
                    $totalRate = 0;

                    if ($Rating_Product_Data->rates->isNotEmpty()) {
                        foreach ($Rating_Product_Data->rates as $value) {
                            $totalRate += $value->rate;
                        }
                        $rates = ($totalRate * 100) / ($Rating_Product_Data->rates->count() * 5);
                        $rateConversion = round((5 * $rates) / 100, 1);
                    }

                    return response()->json(
                        [
                            'save' => 'success',
                            'rateConversion' => $rateConversion,
                            'totalPeopel' => $Rating_Product_Data->rates->count(),
                        ]
                    );
                } else {
                    $Rating_Product_Exist->rate = $request->rate;
                    $Rating_Product_Exist->save();

                    $Rating_Product_Data = Product::find($Rating_Product_Exist->product_id);

                    // Rating Counte
                    $rateConversion = 0;
                    $totalRate = 0;

                    if ($Rating_Product_Data->rates->isNotEmpty()) {
                        foreach ($Rating_Product_Data->rates as $value) {
                            $totalRate += $value->rate;
                        }
                        $rates = ($totalRate * 100) / ($Rating_Product_Data->rates->count() * 5);
                        $rateConversion = round((5 * $rates) / 100, 1);
                    }

                    return response()->json(
                        [
                            'save' => 'success',
                            'rateConversion' => $rateConversion,
                            'totalPeopel' => $Rating_Product_Data->rates->count(),
                        ]
                    );
                }
            }
        } else {
            return response()->json(['save' => 'boom']);
        }
    }
}
