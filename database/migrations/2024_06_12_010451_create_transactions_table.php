<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->unsignedBigInteger('order_id');
            $table->double('amount');
            $table->string('status');
            $table->string('payment_method');
            $table->string('payment_gateway')->nullable();
            $table->string('payment_ref')->nullable();

            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->index(['id', 'order_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
