<?php

use Illuminate\Database\Seeder;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'superadmin',
            'guard_name'=>'web',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name'=>'web',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('roles')->insert([
            'name' => 'inventory_manager',
            'guard_name'=>'web',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('roles')->insert([
            'name' => 'order_manager',
            'guard_name'=>'web',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('roles')->insert([
            'name' => 'customer',
            'guard_name'=>'web',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
    }
}
