<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReclutamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclutamientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Siglas');
            $table->string('Cargo');
            $table->text('Descripcion');
            $table->string('Semestre')->nullable();
            $table->string('Promedio')->nullable();
            $table->string('Conocimientos')->nullable();
            $table->string('Disponibilidad')->default('No');
            $table->date('Fecha');
            $table->time('Hora');
            $table->string('Lugar');
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
        Schema::dropIfExists('reclutamientos');
    }
}
