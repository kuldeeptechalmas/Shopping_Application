<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\SubCatagory;
use Illuminate\Http\Request;

class SubCatagoryController extends Controller
{
    // Sub Category Add
    public function sub_catagory_add(Request $request)
    {
        if ($request->maincategory) {
            $validator = $request->validate(
                [
                    "name" => "required",
                ],
                [
                    "name.required" => "Enter Name is Required.",
                ]
            );
            $data1 = new CategoryProduct();
            $data1->category_name = $request->maincategory;
            $data1->save();

            $data = new SubCatagory();
            $data->name = $request->name;
            $data->catagroy_id = $data1->id;
            $data->save();

            return response()->json(["responce" => "save", "url" => route('Category.Page')]);
        } else {
            $validator = $request->validate(
                [
                    "name" => "required",
                    "catagory" => "required",
                ],
                [
                    "name.required" => "Enter Name is Required.",
                    "catagory.required" => "Enter Category Select is Required.",
                ]
            );

            $data = new SubCatagory();
            $data->name = $request->name;
            $data->catagroy_id = $request->catagory;
            $data->save();

            return response()->json(["responce" => "save", "url" => route('Category.Page')]);
        }
    }

    // Sub Category Delete
    public function sub_catagory_delete(Request $request)
    {
        $data = SubCatagory::find($request->deleteid);
        $data->delete();

        return response()->json(["responce" => "delete"]);
    }
}
