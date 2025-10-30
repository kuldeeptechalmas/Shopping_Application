<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    use SoftDeletes;
    protected $fillable = [
        "name",
        "description",
        "image",
        "stock",
        "category_id",
        "image",
        "status",
        "price",
        "sub_category_id",
        "admin_id",
        "discount",
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupen::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCatagory::class);
    }
    public function rates()
    {
        return $this->hasMany(Rating::class);
    }

    public function ratesByone()
    {
        return $this->belongsTo(Rating::class, 'product_id');
    }
}
