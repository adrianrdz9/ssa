<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeriaEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feria_eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Siglas');
            $table->string('Titulo');
            $table->string('Por');
            $table->string('Tipo');
            $table->date('Dia');
            $table->time('Hora');
            $table->string('Lugar');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feria_eventos');
    }
}
