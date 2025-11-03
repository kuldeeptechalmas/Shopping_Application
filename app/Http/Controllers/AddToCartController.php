<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\CategoryProduct;
use App\Models\CustomerAndShopkeeper;
use App\Models\FavouriceProduct;
use App\Models\Product;
use App\Models\SubCatagory;
use App\Models\UserCoupunData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $cart->message = "";
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
            Session::put('gest_addtocart_data', $cart);
            return redirect()->route("login");
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

                if ($request->action == "Search") {

                    $data_of_input = $request->search_data;
                    if ($data_of_input == '') {
                        return redirect()->route("MainIndex");
                    }

                    $product = Product::where("name", "like", "%{$data_of_input}%")
                        ->orWhere("brand", "like", "%{$data_of_input}%")
                        ->get();
                    $productData = $product->first();

                    $categoryname = $productData->category->category_name ?? '';
                    $subcategoryname = $productData->subcategory->name ?? '';

                    if ($subcategoryname != "") {

                        $Brand_Name_Get = SubCatagory::where('name', $subcategoryname)->first();
                        $Brand_name_Product = Product::select('brand', DB::raw("count(*) as total"))
                            ->groupBy('brand')
                            ->where("sub_category_id", $Brand_Name_Get->id)
                            ->get();
                    } else {
                        $Brand_name_Product = "";
                    }

                    // Favourite Product
                    if (Session::get("customeremail")) {
                        $user_data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();
                        $wishlist = FavouriceProduct::where("user_id", $user_data->id)->get();

                        return view(
                            "IndexProductShow.Search.searchproduct",
                            [
                                "data" => $product,
                                "brandproduct" => $Brand_name_Product,
                                "categoryname" => $categoryname,
                                "subcategoryname" => $subcategoryname,
                                "inputdata" => $data_of_input,
                                "wishlist" => $wishlist
                            ]
                        );
                    }
                    // $product = Product::where("name", "like", "%" . $data_of_input . "%")->get();
                    return view(
                        "IndexProductShow.Search.searchproduct",
                        [
                            "data" => $product,
                            "brandproduct" => $Brand_name_Product,
                            "categoryname" => $categoryname,
                            "subcategoryname" => $subcategoryname,
                            "inputdata" => $data_of_input
                        ]
                    );
                }
            }

            return view("IndexProductShow.AddToCart.addtocartindex", ["datacart" => $addtocart, "usercoupondata" => $couponuserdata]);
        } else {
            return redirect()->route("login");
        }
    }

    public function delete_cart(Request $request)
    {
        if (Session::get("customeremail")) {

            $data = CustomerAndShopkeeper::where("email", Session::get("customeremail"))->first();

            $addtocart1 = AddToCart::find($request->cartId);

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
                        'redirect_url' => $request->url
                    ]);
                }

                $addtocart1->quantity = $request->queantity + 1;
                $addtocart1->save();

                $product = Product::find($request->product_id);
                $product->stock = $product->stock - 1;
                $product->save();


                return response()->json([
                    'status' => 'success',
                    'redirect_url' => $request->url
                ]);
            }
            if ($request->action == "minus") {

                if ($request->queantity == 1) {

                    $productData->stock += $addtocart1->quantity;
                    $productData->save();
                    $addtocart1->delete();
                    return response()->json([
                        'status' => 'success',
                        'redirect_url' => $request->url
                    ]);
                }
                $addtocart1->quantity = $request->queantity - 1;
                $addtocart1->save();

                $product = Product::find($request->product_id);
                $product->stock = $product->stock + 1;
                $product->save();
                return response()->json([
                    'status' => 'success',
                    'redirect_url' => $request->url
                ]);
            }
        }
        return response()->json([
            'status' => 'success',
            'redirect_url' => $request->url
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
            if (isset($request->option)) {
                return response()->json([
                    'status' => 'success',
                    'outofstock_error' => 'OutOfStock',
                    'redirect_url' => $request->url
                ]);
            }
            return response()->json([
                'status' => 'success',
                'outofstock_error' => 'OutOfStock',
                'redirect_url' => route('addtocart_get_all')
            ]);
        }
    }
}
