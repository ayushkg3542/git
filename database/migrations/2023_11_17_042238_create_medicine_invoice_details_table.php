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
        Schema::create('medicine_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->unsignedBigInteger('supplier');
            $table->foreign('supplier')->references('id')->on('medicine_supplier_masters')->onDelete('cascade');
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('bank')->nullable();
            $table->foreign('bank')->references('id')->on('bank_masters')->onDelete('cascade');
            $table->string('narration')->nullable();
            $table->string('invoice_total');
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
        Schema::dropIfExists('medicine_invoice_details');
    }
};
