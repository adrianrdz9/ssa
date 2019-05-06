<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaruselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carusels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Titulo')->nullable();
            $table->text('Descripcion')->nullable();
            $table->string('Link')->nullable();
            $table->string('Tipo');
            $table->integer('Estado')->default('1');
            $table->string('Imagen');

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
        Schema::dropIfExists('carusels');
    }
}
