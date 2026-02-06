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
        Schema::create('attribute_term_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('lang_id');
            $table->unsignedBigInteger('attribute_term_id');
            $table->timestamps();

            $table->foreign('lang_id')->references('id')->on('langs')->onDelete('cascade');
            $table->foreign('attribute_term_id')->references('id')->on('attribute_terms')->onDelete('cascade');

            $table->unique(['lang_id', 'attribute_term_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_term_translations');
    }
};
