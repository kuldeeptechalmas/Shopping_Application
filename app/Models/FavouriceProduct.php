<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavouriceProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="favourite_product";
    protected $fillable=[
        "product_id",
        "user_id",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
