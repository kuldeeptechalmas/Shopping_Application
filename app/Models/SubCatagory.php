<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCatagory extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "subcatagory";

    protected $fillable = [
        "category_name",
    ];

    public function subcategory()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}
