<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopkeeperController extends Controller
{
    public function dashboard()
    {
        return view("Shopkeeper.index");
    }
    
}
