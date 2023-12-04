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
        Schema::create('patient_medical_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patient_personal_details')->onDelete('cascade');
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->longText('present_disease')->nullable();
            $table->longText('past_history')->nullable();
            $table->longText('family_history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_medical_details');
    }
};
