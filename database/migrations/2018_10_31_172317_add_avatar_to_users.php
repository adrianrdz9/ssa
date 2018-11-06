<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('avatar_file_name')->nullable();
            $table->integer('avatar_file_size')->nullable();
            $table->string('avatar_content_type')->nullable();
            $table->timestamp('avatar_updated_at')->nullable();
            $table->string('avatar_variants', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
