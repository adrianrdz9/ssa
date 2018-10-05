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
            $table->integer('account_number');
            $table->string('name');
            $table->string('last_name');
            $table->string('height');
            $table->string('weight');
            $table->date('birthdate');
            $table->string('career');
            $table->string('semester');
            $table->string('curp')->nullable();
            $table->text('address')->nullable();
            $table->string('medical_service');
            $table->string('blood_type');
            $table->string('medical_card_no');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
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
