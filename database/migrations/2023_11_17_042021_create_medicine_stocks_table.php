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
        Schema::create('medicine_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicine');
            $table->foreign('medicine')->references('id')->on('medicine_masters')->onDelete('cascade');
            $table->integer('stock');
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('medicine_status_masters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_stocks');
    }
};
