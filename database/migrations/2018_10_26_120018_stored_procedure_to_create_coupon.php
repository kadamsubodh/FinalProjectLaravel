<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StoredProcedureToCreateCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE PROCEDURE addNewCoupon(IN couponCode varchar(45),IN percent_off_discount double(12,2), IN number_of_uses INT ,IN created_by_user INT(10) unsigned,IN modify_by_user INT(10) unsigned) BEGIN
            DECLARE count_sec INT;
            IF not EXISTS(select id from coupons where code=couponCode) THEN           
                insert into coupons(code,percent_off,no_of_uses,created_by, modify_by) values(couponCode,percent_off_discount ,number_of_uses,created_by_user,modify_by_user);
            ELSE
                set count_sec=0;
            END IF;
            END
            ');
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
