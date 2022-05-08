<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_peliculas', function (Blueprint $table) {
            $table->id();
           $table->foreignId('horario_id')->constrained()->onDelete('cascade');
           $table->foreignId('peliculas_id')->constrained()->onDelete('cascade');
     

            $table->integer('plazos_libres')->default(100);
            $table->integer('precio')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_peliculas');
    }
};
