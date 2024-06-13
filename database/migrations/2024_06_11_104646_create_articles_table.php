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
            $table->string("title")->nullable();
            $table->integer("source_id")->nullable();
            $table->integer("author_id")->nullable();
            $table->string("url")->nullable();
            $table->longText("urlOfImage")->nullable();
            $table->longText("Descreption")->nullable();
            $table->string("published_at");
            $table->longText("content")->nullable();
            $table->timestamps();
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
