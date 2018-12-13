<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('users', function (Blueprint $table) {
            
             $table->increments('id');
             $table->string('Siglas')->unique();
             $table->string('Nombre');
             $table->text('Descripcion');
             $table->string('Logo');
             $table->string('Foto');
             $table->string('password', 60)->default('$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm');
             $table->boolean('active')->default(0);
             $table->string('confirm_token', 100);
             $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
