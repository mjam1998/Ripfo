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
        Schema::create('article_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->tinyInteger('innovation')->default(0);
            $table->tinyInteger('subject_importance')->default(0);
            $table->tinyInteger('result_usage')->default(0);
            $table->tinyInteger('struct_science')->default(0);
            $table->tinyInteger('write_principle')->default(0);
            $table->tinyInteger('science_content')->default(0);
            $table->tinyInteger('resource')->default(0);
            $table->tinyInteger('pen')->default(0);
            $table->tinyInteger('update')->default(0);
            $table->tinyInteger('prestige')->default(0);
            $table->tinyInteger('total_score')->default(0);

            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_scores');
    }
};
