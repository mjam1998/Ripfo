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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('education_filed_id');
            $table->tinyInteger('title');
            $table->string('name',255);
            $table->string('name_en',255);
            $table->string('email')->unique();
            $table->tinyInteger('education');
            $table->string('mobile',20);
            $table->string('fax',30)->nullable();
            $table->tinyInteger('academic_rank');
            $table->string('phone',20)->nullable();
            $table->string('research_favorite',300);
            $table->string('url',255)->nullable();
            $table->string('postal_code',15)->nullable();
            $table->string('city',255);
            $table->string('city_en',255);
            $table->string('organ',255);
            $table->string('organ_en',255);
            $table->string('national_code')->unique();
            $table->string('user_name')->unique();
            $table->boolean('is_juror_want')->default(0);
            $table->string('orcid',20)->nullable();
            $table->string('email_help',300)->nullable();
            $table->string('verify_code',20);
            $table->boolean('is_verified')->default(0);
            $table->text('user_description')->nullable();
            $table->string('bank_name',255)->nullable();
            $table->string('bank_card', 20)->nullable();
            $table->string('bank_account', 30)->nullable();


            $table->string('password',300);

            $table->timestamps();

            $table->foreign('education_filed_id')->references('id')->on('education_fileds');
        });



        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');

        Schema::dropIfExists('sessions');
    }
};
