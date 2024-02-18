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
        Schema::create('worker_teaching_models', function (Blueprint $table) {
            $table->id();
            $table->string('t_category');
            $table->string('s_category');
            $table->unsignedBigInteger('worker_id');
            $table->foreign('worker_id')->references('id')->on('worker_models')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_teaching_models');
    }
};
