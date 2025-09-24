<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerOrder extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="customerorder";
    protected $fillable =[
        "name",
        "email",
        "phone",
        "country",
        "state",
        "city",
        "pincode",
        "address",
        "customer_id",
        "product_id",
        "order_date",
        "delivery_date",
        "status",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
