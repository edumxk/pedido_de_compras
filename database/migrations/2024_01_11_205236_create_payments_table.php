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
            $table->enum('type',['debito','credito', 'boleto', 'pix', 'dinheiro', 'cheque', 'outros']);
            $table->string('installments');
            $table->string('days');
            $table->string('discount')->nullable();
            $table->string('addition')->nullable();
            $table->string('payment_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('budget_id')->constrained('budgets');
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
