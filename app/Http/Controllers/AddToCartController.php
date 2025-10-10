<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\Product;
use App\Models\UserCoupunData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddToCartController extends Controller
{
    protected $catagorydata;
    public function __construct()
    {
        $this->catagorydata = CategoryProduct::all();
    }
    // Shopkeeper
    public function index($product_id)
    {
        if (Session::get("customeremail")) {

            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))
                ->first();
            $findCartData = AddToCart::where("user_id", $data->id)
                ->where("product_id", $product_id)->first();
            $productData = Product::find($product_id);

            if ($findCartData) {

                if ($productData->stock == 0) {
                    return redirect()->route("addtocart_get_all");
                }

                $findCartData->quantity += 1;
                $findCartData->save();

                $product = Product::find($product_id);
                $product->stock = $product->stock - 1;
                $product->save();
                if ($product->stock == 0) {
                    $product->status = "out of stock";
                    $product->save();
                }

                return redirect()->route("addtocart_get_all");
            }

            $cart = new AddToCart();
            $cart->user_id = $data->id;
            $cart->product_id = $product_id;
            $cart->quantity = 1;
            $cart->save();

            $product = Product::find($product_id);
            $product->stock = $product->stock - 1;
            $product->save();

            return redirect()->route("addtocart_get_all");
        } else {

            $cart = array();
            $product = Product::where("id", $product_id)->first();
            $cart[$product_id] = [
                'product_data' => $product,
                "product_id" => $product->id,
                'quantity' => 1,
            ];
            return redirect()->route("login", ["cart" => $cart]);
        }
    }

    public function addtocart_get_all(Request $request)
    {
        if (Session::get("customeremail")) {
            $data1 = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
            $addtocart = AddToCart::where("user_id", $data1->id)->get();
            $couponuserdata = UserCoupunData::where("user_id", $data1->id)->get();

            // Search Add To Cart Data
            if ($request->isMethod("post")) {
                $search_data = $request->search_data;
                if ($request->action == "Search") {
                    $searchAddtocart = AddToCart::whereHas("product", function ($query) use ($search_data) {
                        $query->where("name", "like", "%" . $search_data . "%");
                    })->where("user_id", $data1->id)->get();

                    return view("IndexProductShow.AddToCart.addtocartindex", ["datacart" => $searchAddtocart, "usercoupondata" => $couponuserdata]);
                }
            }

            return view("IndexProductShow.AddToCart.addtocartindex", ["datacart" => $addtocart, "usercoupondata" => $couponuserdata]);
        } else {
            return redirect()->route("login");
        }
    }

    public function delete_cart($cartid)
    {
        if (Session::get("customeremail")) {

            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

            $addtocart1 = AddToCart::where("product_id", $cartid)
                ->where("user_id", $data->id)->first();

            $productData = Product::find($addtocart1->product_id);

            $productData->stock += $addtocart1->quantity;
            $productData->save();

            if ($productData->stock != 0) {
                $productData->status = "in stock";
                $productData->save();
            }

            $addtocart1->delete();

            return redirect()->route("addtocart_get_all");
        }
    }

    public function update_queantity(Request $request)
    {
        if (Session::get("customeremail")) {

            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

            $addtocart1 = AddToCart::where("product_id", $request->product_id)
                ->where("user_id", $data->id)->first();

            $productData = Product::find($request->product_id);

            if ($request->action == "plus") {
                // dd($productData->stock);
                if ($productData->stock == 0) {
                    return response()->json([
                        'status' => 'success',
                        'outofstock_error' => 'OutOfStock',
                        'redirect_url' => route('addtocart_get_all')
                    ]);
                }

                $addtocart1->quantity = $request->queantity + 1;
                $addtocart1->save();

                $product = Product::find($request->product_id);
                $product->stock = $product->stock - 1;
                $product->save();

                if ($product->stock == 0) {
                    $product->status = "out of stock";
                    $product->save();
                }


                return response()->json([
                    'status' => 'success',
                    'redirect_url' => route('addtocart_get_all')
                ]);
            }
            if ($request->action == "minus") {

                if ($request->queantity == 1) {

                    $productData->stock += $addtocart1->quantity;
                    $productData->save();

                    if ($productData->stock != 0) {
                        $productData->status = "in stock";
                        $productData->save();
                    }
                    $addtocart1->delete();

                    return response()->json([
                        'status' => 'success',
                        'redirect_url' => route('addtocart_get_all')
                    ]);
                }
                $addtocart1->quantity = $request->queantity - 1;
                $addtocart1->save();

                $product = Product::find($request->product_id);
                $product->stock = $product->stock + 1;
                $product->save();

                if ($product->stock != 0) {
                    $product->status = "in stock";
                    $product->save();
                }
                return response()->json([
                    'status' => 'success',
                    'redirect_url' => route('addtocart_get_all')
                ]);
            }
        }
        return response()->json([
            'status' => 'success',
            'redirect_url' => route('addtocart_get_all')
        ]);
    }
    public function Buy_Now_update_queantity(Request $request)
    {
        if (Session::get("customeremail")) {

            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

            $addtocart1 = AddToCart::where("product_id", $request->product_id)
                ->where("user_id", $data->id)->first();

            $productData = Product::find($request->product_id);

            if ($request->action == "plus") {
                // dd($productData->stock);
                if ($productData->stock == 0) {
                    return response()->json([
                        'status' => 'success',
                        'outofstock_error' => 'OutOfStock',
                        'redirect_url' => route('buy.Now.Summary')
                    ]);
                }

                $addtocart1->quantity = $request->queantity + 1;
                $addtocart1->save();

                $product = Product::find($request->product_id);
                $product->stock = $product->stock - 1;
                $product->save();


                return response()->json([
                    'status' => 'success',
                    'redirect_url' => route('buy.Now.Summary')
                ]);
            }
            if ($request->action == "minus") {

                if ($request->queantity == 1) {

                    $productData->stock += $addtocart1->quantity;
                    $productData->save();
                    $addtocart1->delete();
                    return response()->json([
                        'status' => 'success',
                        'redirect_url' => route('buy.Now.Summary')
                    ]);
                }
                $addtocart1->quantity = $request->queantity - 1;
                $addtocart1->save();

                $product = Product::find($request->product_id);
                $product->stock = $product->stock + 1;
                $product->save();
                return response()->json([
                    'status' => 'success',
                    'redirect_url' => route('buy.Now.Summary')
                ]);
            }
        }
        return response()->json([
            'status' => 'success',
            'redirect_url' => route('buy.Now.Summary')
        ]);
    }

    public function direct_change_quentity(Request $request)
    {
        if (Session::get("customeremail")) {

            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

            $addtocart1 = AddToCart::where("product_id", $request->product_id)
                ->where("user_id", $data->id)->first();

            $productData = Product::find($request->product_id);

            if ($request->queantity == 0) {
                // Enter value is Zero
                $productData->stock += $addtocart1->quantity;
                $productData->save();
                $addtocart1->delete();
            } else {
                // Enter value biger then Stock
                if ($request->queantity > $productData->stock) {
                    $productData->stock += $addtocart1->quantity;

                    if ($productData->stock > $request->queantity) {
                        $productData->stock -= $request->queantity;
                        $productData->save();

                        if ($productData->stock != 0) {
                            $productData->status = "in stock";
                            $productData->save();
                        } else {
                            $productData->status = "out of stock";
                            $productData->save();
                        }

                        $addtocart1->quantity = $request->queantity;
                        $addtocart1->save();
                    } else {

                        $addtocart1->quantity = $productData->stock;
                        $productData->stock = 0;
                        $productData->save();

                        if ($productData->stock == 0) {
                            $productData->status = "out of stock";
                            $productData->save();
                        }
                        $addtocart1->save();
                    }
                } else {
                    // Enter value smaler then Stock

                    if ($addtocart1->quantity > $request->queantity) {
                        $productData->stock += $addtocart1->quantity;
                        $productData->stock -= $request->queantity;
                        $productData->save();

                        if ($productData->stock != 0) {
                            $productData->status = "in stock";
                            $productData->save();
                        } else {
                            $productData->status = "out of stock";
                            $productData->save();
                        }
                    }
                    if ($addtocart1->quantity < $request->queantity) {
                        $productData->stock += $addtocart1->quantity;
                        $productData->stock -= $request->queantity;
                        $productData->save();

                        if ($productData->stock != 0) {
                            $productData->status = "in stock";
                            $productData->save();
                        } else {
                            $productData->status = "out of stock";
                            $productData->save();
                        }
                    }

                    $addtocart1->quantity = $request->queantity;
                    $addtocart1->save();
                }
            }
            return response()->json([
                'status' => 'success',
                'outofstock_error' => 'OutOfStock',
                'redirect_url' => route('addtocart_get_all')
            ]);
        }
    }
}
