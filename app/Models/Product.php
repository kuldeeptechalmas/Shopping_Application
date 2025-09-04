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
        "sub_category_id"
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}
