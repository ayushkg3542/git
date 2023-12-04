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
        Schema::create('patient_payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patient_personal_details')->onDelete('cascade');
            $table->date('billing_date');
            $table->integer('previous_amount')->nullable();
            $table->integer('current_amount')->nullable();
            $table->integer('total_amount')->nullable();
            $table->integer('received_amount')->nullable();
            $table->integer('balance_amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('reference_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_payment_details');
    }
};
