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
        Schema::create('provisions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->enum('status', ['pending', 'finished', 'canceled'])->default('pending');
            $table->foreignId('purchase_order_id')->constrained('purchase_orders');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('interaction_id')->constrained('interactions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provisions');
    }
};
