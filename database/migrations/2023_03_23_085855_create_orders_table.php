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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('category_type', 50)->nullable();
            $table->string('title')->nullable();
            $table->integer('total_month')->nullable();
            $table->double('total_amount');
            $table->double('per_month_amount');
            $table->date('loan_payment_date');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
