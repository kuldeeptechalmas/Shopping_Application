<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customerorder', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("phone");
            $table->string("country");
            $table->string("state");
            $table->string("city");
            $table->string("pincode");
            $table->string("address");
            $table->string("quantity");
            $table->date('order_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->softDeletes();
            $table->bigInteger("customer_id");
            $table->foreign("customer_id")->references("id")->on("customerandshopkeeper");
            $table->bigInteger("product_id");
            $table->foreign("product_id")->references("id")->on("products");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customerorder');
    }
};
