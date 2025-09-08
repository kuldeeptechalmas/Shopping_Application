<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{
    use SoftDeletes;
    protected $table = "productcategory";

    protected $fillable = [
        "category_name",
    ];



}
