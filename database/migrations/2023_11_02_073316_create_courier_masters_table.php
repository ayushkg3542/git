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
        Schema::create('courier_masters', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('address')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('country');
            $table->string('state');
            $table->integer('price');
            $table->date('effective_from');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courier_masters');
    }
};
