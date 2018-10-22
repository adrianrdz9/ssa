<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->string('Titulo');
            $table->text('DescripcionCorta');
            $table->text('Descripcion');
            $table->time('Fecha');
            $table->string('Folio');
            $table->string('Disponible');
            $table->string('ImagenC');
            $table->string('ImagenR');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}
