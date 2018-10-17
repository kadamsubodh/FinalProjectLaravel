<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeAssocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('product_attribute_assocs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->unsigned();
            $table->unsignedInteger('product_attribute_id')->unsigned();
            $table->unsignedInteger('product_attribute_value_id')->unsigned();
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes');
            $table->foreign('product_attribute_value_id')->references('id')->on('product_attribute_assocs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_assocs');
    }
}
