<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAndShopkeeper extends Model
{
    protected $table = "customerandshopkeeper";

    protected $fillable = [
        "name",
        "email",
        "phone",
        "address",
        "password",
        "rols",
        "gender",
        "city",
        "state",
        "country",
        "pincode",

    ];
    use SoftDeletes;

    
}
