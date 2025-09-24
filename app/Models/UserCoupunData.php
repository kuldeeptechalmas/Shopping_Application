<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class UserCoupunData extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="user_coupun_data";
    protected $fillable=[
        "product_id",
        "user_id",
        "coupon_id",
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupen::class);
    }
}
