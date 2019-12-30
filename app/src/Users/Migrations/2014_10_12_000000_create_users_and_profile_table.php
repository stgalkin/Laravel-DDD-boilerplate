<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersAndProfileTable
 */
class CreateUsersAndProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('email')->unique();
            $table->string('password');

            $table->primary('id');
        });

        Schema::create('users_profiles', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('first_name');
            $table->string('last_name');

            $table->primary('id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('users_profiles');
    }
}
