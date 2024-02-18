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
        Schema::create('worker_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ci')->unique();
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('address_models')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_models');
    }
};
