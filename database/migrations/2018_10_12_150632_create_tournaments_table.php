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

            $table->text('responsable');
            $table->date('technic_meeting');
            $table->string('name');
            $table->string('place');
            $table->integer('max_teams');
            $table->integer('min_per_team');
            $table->integer('max_per_team');
            $table->boolean('only_representative')->default(false);
            $table->date('date');
            $table->date('signup_close');
            $table->string('semester');
            $table->nullableTimestamps();

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
