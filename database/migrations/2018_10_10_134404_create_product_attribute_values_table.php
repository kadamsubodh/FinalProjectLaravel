<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_attribute_id')->unsigned();
            $table->string('attribute_value',45);
            $table->integer('created_by');
            $table->integer('modify_by');
            $table->timestamps();
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_values');
    }
}
