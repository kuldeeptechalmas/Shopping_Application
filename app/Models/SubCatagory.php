<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCatagory extends Model
{
    use HasFactory;
    protected $table = "subcatagory";

    public function subcategory()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}
