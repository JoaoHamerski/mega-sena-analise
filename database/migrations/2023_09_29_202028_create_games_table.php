d<?php

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
                $table->string('concurso')->unique();
                $table->date('date');
                $table->unsignedTinyInteger('bola_1');
                $table->unsignedTinyInteger('bola_2');
                $table->unsignedTinyInteger('bola_3');
                $table->unsignedTinyInteger('bola_4');
                $table->unsignedTinyInteger('bola_5');
                $table->unsignedTinyInteger('bola_6');
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
