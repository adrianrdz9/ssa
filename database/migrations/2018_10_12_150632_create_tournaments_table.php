<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sport_id');
            $table->foreign('sport_id')->references('id')->on('sports');
            $table->string('name');
            $table->integer('max_room');
            $table->date('date');
            $table->enum('branch', ['femenil', 'varonil', 'mixto']);
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
        Schema::dropIfExists('tournaments');
    }
}
