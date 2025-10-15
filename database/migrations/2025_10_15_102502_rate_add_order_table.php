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
        Schema::table("customerorder", function (Blueprint $table) {
            $table->bigInteger("rate_id");
            $table->foreign("rate_id")->references("id")->on("rating_product");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("customerorder", function (Blueprint $table) {
            $table->dropColumn("rate_id");
        });
    }
};
