<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes', function (Blueprint $table) {
            //$table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->integer('NCargo');
            $table->string('Siglas');
            $table->string('Cargo');
            $table->string('Nombre');
            $table->string('Email');
            $table->string('Numero');
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
        Schema::dropIfExists('integrantes');
    }
}
