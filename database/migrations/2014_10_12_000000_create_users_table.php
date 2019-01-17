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
            //Actividades deportivas
            $table->string('account_number')->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('career')->nullable();
            $table->string('semester')->nullable();
            $table->string('curp')->nullable();
            $table->text('address')->nullable();
            $table->string('medical_service')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('medical_card_no')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            
            //Agrupaciones
            $table->string('Siglas')->nullable();
            $table->string('Nombre')->nullable();
            $table->string('Descripcion')->nullable();
            $table->string('Logo')->nullable();
            $table->string('Foto')->nullable();
            $table->boolean('active')->default(0);
            
            //Numero de cuenta o siglas
            $table->string('username');
            
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
