<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    
}
