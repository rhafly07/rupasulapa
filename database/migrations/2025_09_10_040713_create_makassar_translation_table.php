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
        Schema::create('makassar_translation', function (Blueprint $table) {
            $table->id();
            $table->string('indonesia_word')->index();
            $table->string('makassar_word')->nullable();
            $table->string('pronunciation')->nullable();
            $table->text('lontara')->nullable();
            $table->text('indonesia_meaning')->nullable();
            $table->string('word_class')->nullable();
            $table->timestamps();

            // Index untuk pencarian yang lebih cepat
            $table->unique('indonesia_word');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('makassar_translation');
    }
};
