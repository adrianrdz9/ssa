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
           
            $table->increments('Folio');
            $table->string('Titulo');
            $table->text('DescripcionCorta');
            $table->text('Descripcion');
            $table->date('Fecha');
            $table->string('Disponible')->default('1');
            $table->string('ImagenC')->nullable();
            $table->string('ImagenR')->nullable();
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
        Schema::dropIfExists('noticias');
    }
}
