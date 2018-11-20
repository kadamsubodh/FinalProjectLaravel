<?php

use Illuminate\Database\Seeder;

class paymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_gateways')->insert([
            'name' => 'COD',            
            'created_by'=>2,
            'created_at'=>date("Y-m-d H:i:s"),
            'modify_by'=>2,
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('payment_gateways')->insert([
            'name' => 'payPal',
            'created_by'=>2,
            'created_at'=>date("Y-m-d H:i:s"),
            'modify_by'=>2,
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);        
    }
}
