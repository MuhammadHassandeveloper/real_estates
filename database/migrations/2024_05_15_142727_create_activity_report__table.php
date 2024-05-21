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
        Schema::create('activity_report', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('system_id');
            $table->string('heading');
            $table->text('content');
            $table->text('color');
            $table->text('type');
            $table->text('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_report');
    }
};
