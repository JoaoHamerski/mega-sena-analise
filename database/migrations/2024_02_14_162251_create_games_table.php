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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('concurso');
            $table->date('data');
            $table->unsignedTinyInteger('bola_01');
            $table->unsignedTinyInteger('bola_02');
            $table->unsignedTinyInteger('bola_03');
            $table->unsignedTinyInteger('bola_04');
            $table->unsignedTinyInteger('bola_05');
            $table->unsignedTinyInteger('bola_06');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
