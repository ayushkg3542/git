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
        Schema::create('general_ledgers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('ledger_group_masters')->onDelete('cascade');
            $table->unsignedBigInteger('sub_group_id')->nullable();
            $table->foreign('sub_group_id')->references('id')->on('ledger_sub_group_masters')->onDelete('cascade');
            $table->string('eserial_type')->nullable();
            $table->unsignedBigInteger('eserial_number')->nullable();
            $table->string('DrCr')->nullable();
            $table->string('amount')->nullable();
            $table->string('narration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_ledgers');
    }
};
