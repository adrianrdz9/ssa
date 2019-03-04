<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCredencialAndCarnetToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('credencial_file_name')->nullable();
            $table->integer('credencial_file_size')->nullable();
            $table->string('credencial_content_type')->nullable();
            $table->timestamp('credencial_updated_at')->nullable();
            $table->string('credencial_variants')->nullable();

            $table->string('carnet_file_name')->nullable();
            $table->integer('carnet_file_size')->nullable();
            $table->string('carnet_content_type')->nullable();
            $table->timestamp('carnet_updated_at')->nullable();
            $table->string('carnet_variants')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
