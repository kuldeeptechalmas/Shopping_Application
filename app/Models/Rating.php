<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rating_product';
    protected $fillable = ['rate', 'user_id', 'product_id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
