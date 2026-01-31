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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('period_number_id')->nullable();
            $table->unsignedBigInteger('juror_id')->nullable();
            $table->unsignedBigInteger('juror_offer_id')->nullable();
            $table->string('code',20)->unique();
            $table->string('title',300);
            $table->string('title_en',300);
            $table->text('summary');
            $table->text('summary_en');
            $table->text('writers')->nullable();
            $table->text('writers_en')->nullable();
            $table->string('doi',200)->nullable();
            $table->string('file_primary',300);
            $table->string('file_secondary',300)->nullable();
            $table->string('juror_file',300)->nullable();
            $table->text('writer_des_juror')->nullable();
            $table->text('juror_des_writer')->nullable();
            $table->text('juror_des_sec')->nullable();
            $table->text('juror_des_admin')->nullable();
            $table->unsignedBigInteger('visitor_number')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('period_number_pages',255)->nullable();
            $table->string('juror_offer_name',255)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('period_number_id')->references('id')->on('period_numbers');
            $table->foreign('juror_id')->references('id')->on('users');
            $table->foreign('juror_offer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
