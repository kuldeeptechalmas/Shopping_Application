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
        Schema::table("products", function (Blueprint $table) {
            $table->bigInteger("admin_id");
            $table->foreign("admin_id")->references("id")->on("admin");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('admin_id');
            });
    }
};
