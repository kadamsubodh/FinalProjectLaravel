<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('conf_key',45);
            $table->string('conf_value',100);
            $table->enum('status',['1','0']);
            $table->unsignedInteger('created_by')->unsigned();
            $table->unsignedInteger('modify_by')->unsigned();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modify_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuration_tables');
    }
}
