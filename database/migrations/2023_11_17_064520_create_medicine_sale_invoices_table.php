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
        Schema::create('medicine_sale_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_number');
            $table->date('invoice_date');
            $table->unsignedBigInteger('patient');
            $table->foreign('patient')->references('id')->on('patient_personal_details')->onDelete('cascade');
            $table->string('payment_method');
            $table->unsignedBigInteger('bank')->nullable();
            $table->foreign('bank')->references('id')->on('bank_masters')->onDelete('cascade');
            $table->string('narration')->nullable();
            $table->string('invoice_total')->nullable();
            $table->string('cgst')->nullable();
            $table->string('sgst')->nullable();
            $table->string('gst')->nullable();
            $table->string('labour')->nullable();
            $table->string('freight')->nullable();
            $table->string('invoice_net')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_sale_invoices');
    }
};
