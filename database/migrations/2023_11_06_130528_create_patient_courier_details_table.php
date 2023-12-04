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
        Schema::create('patient_courier_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patient_personal_details')->onDelete('cascade');
            $table->unsignedBigInteger('courier_company');
            $table->foreign('courier_company')->references('id')->on('courier_masters')->onDelete('cascade');
            $table->string('weight');
            $table->double('price');
            $table->unsignedBigInteger('status')->default(1);
            $table->foreign('status')->references('id')->on('courier_status_masters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_courier_details');
    }
};
