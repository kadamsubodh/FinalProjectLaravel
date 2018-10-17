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
            $table->string('firstname',45);
            $table->string('lastname',45);
            $table->string('email',45);
            $table->string('password',100);
            $table->enum('status',['1','0']);
            $table->date('created_date');
            $table->string('fb_token',100);
            $table->string('twitter_token',100);
            $table->string('google_token',100);
            $table->enum('registration_method',['n','f','t','g']);
            $table->unsignedInteger('role_id')->unsigned();
            $table->timestamps();
            $table->text('remember_token');
            $table->foreign('role_id')->references('id')->on('roles');
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
