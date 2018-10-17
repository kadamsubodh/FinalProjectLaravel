<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unsigned();
            $table->integer('shipping_method');
            $table->string('AWB_NO',100);
            $table->unsignedInteger('payment_gateway_id')->unsigned();
            $table->string('transaction_id',100);
            $table->enum('status',['1','0']);
            $table->float('grand_total',12,2);
            $table->float('shipping_charges',12,2);
            $table->unsignedInteger('coupon_id')->unsigned();
            $table->string('billing_address_1',100);
            $table->string('billing_address_2',100);
            $table->string('billing_city',45);
            $table->string('billing_state',45);
            $table->string('billing_country',45);
            $table->string('billing_zipcode',45);
            $table->string('shipping_address_1',100);
            $table->string('shipping_address_2',100);
            $table->string('shipping_city',45);
            $table->string('shipping_state',45);
            $table->string('shipping_country',45);
            $table->string('shipping_zipcode',45);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('payment_gateway_id')->references('id')->on('payment_gateways');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_orders');
    }
}
