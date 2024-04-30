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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            
            // Consider using boolean instead of string for cash_delivery to represent true/false values.
            $table->string('cash_delivery')->nullable(); 
            
            $table->decimal('total_amount', 10, 2)->nullable(); // Assuming total_amount is a monetary value, use decimal for precision.
            
            // Consider using an enum or a foreign key reference for payment_type instead of a string.
            $table->string('payment_type')->nullable();
            
            $table->string('invoice_no')->nullable();
            
            // Consider using a date or datetime field for order_date instead of string.
            $table->string('order_date')->nullable();
            $table->string('order_month')->nullable();
            $table->string('order_year')->nullable();
            
            // Consider combining order_date into a single datetime field instead of separate date parts.
            $table->string('status')->nullable();
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
