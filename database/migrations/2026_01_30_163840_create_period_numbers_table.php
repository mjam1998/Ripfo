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
        Schema::create('period_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id');
            $table->string('name',255);
            $table->string('name_en',255);
            $table->string('pages',255)->nullable();
            $table->string('pages_en',255)->nullable();
            $table->string('time_name',255)->nullable();
            $table->string('time_name_en',255)->nullable();
            $table->string('image',300)->nullable();

            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period_numbers');
    }
};
