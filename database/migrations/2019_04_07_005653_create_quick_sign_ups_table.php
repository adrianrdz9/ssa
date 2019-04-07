<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuickSignUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('quick_sign_ups', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('account_number');
            $table->unsignedInteger('tournament_id');
            $table->foreign('tournament_id')->references('id')->on('tournaments');

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
        Schema::dropIfExists('quick_sign_ups');
    }
}
