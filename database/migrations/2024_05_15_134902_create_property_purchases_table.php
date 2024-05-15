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
        Schema::create('property_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->integer('agent_id')->nullable();
            $table->double('purchased_price', 10, 2);
            $table->date('purchased_date');
            $table->time('purchased_time');
            $table->string('payment_method');
            $table->string('payment_stripe_id');
            $table->text('status');
            $table->text('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_purchases');
    }
};
