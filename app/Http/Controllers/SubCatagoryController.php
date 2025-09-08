<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\SubCatagory;
use Illuminate\Http\Request;

class SubCatagoryController extends Controller
{
    public function sub_catagory_add(Request $request)
    {
        $validator =$request->validate([
            "name"=> "required",
            "catagory"=> "required",
        ],
        [
            "name.required"=> "Enter Name is Required.",
            "catagory.required"=> "Enter Category Select is Required.",
        ]);

        $data= new SubCatagory();
        $data->name= $request->name;
        $data->catagroy_id = $request->catagory;
        $data->save();

        return response()->json(["responce"=> "save"]);
    }

    public function sub_catagory_delete(Request $request)
    {
        $data= SubCatagory::find($request->deleteid);
        $data->delete();

        return response()->json(["responce"=> "delete"]);
    }
}
