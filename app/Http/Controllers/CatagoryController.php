<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\SubCatagory;
use Illuminate\Http\Request;

class CatagoryController extends Controller
{
    public function index()
    {
        $catagory = CategoryProduct::all();  
        $subCatagory = SubCatagory::all();
        return view("Shopkeeper.catagory_add",["cetagoryexist"=>"yes","catagory"=> $catagory,"subcata"=> $subCatagory]);
    }

    public function catagory_add(Request $request)
    {
        $validator =$request->validate([
            "name"=> "required"
        ],
        [
            "name.required"=> "Enter Category Name is Required.",
        ]) ;

        $data= new CategoryProduct();
        $data->category_name= $request->name;
        $data->save();

        return response()->json(["responce"=> "save"]);
        
    }

    public function catagory_show()
    {
     $catagory = CategoryProduct::all(); 
     $subcatagory= SubCatagory::all(); 
      return view("Shopkeeper.catagorytable",["data"=>$catagory,"subcat"=>$subcatagory]); 
    }
}
