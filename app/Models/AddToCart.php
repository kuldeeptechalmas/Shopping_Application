<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddToCart extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="addtocart";
    protected $fillable=[
        "user_id",
        "product_id",
        "quantity"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(CustomerAndShopkeeper::class);
    }
}
