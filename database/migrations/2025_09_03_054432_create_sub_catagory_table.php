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
        Schema::create('subcatagory', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('catagroy_id');
            $table->foreign('catagroy_id')->references('id')->on('productcategory');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcatagory');
    }
};
