<?php

use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Admin',
            'lastname' => 'admin',
            'email' => 'kadamsubodh0619@gmail.com',
            'password' => bcrypt('subodh123'),
            'status' => '1',
            'created_date' => date("Y-m-d H:i:s"),
            'fb_token' => 'null',
            'twitter_token' => 'null',
            'google_token' => 'null',
            'registration_method' => 'n',
            'role_id' => '1',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
            'remember_token'=>null,
        ]);

        DB::table('users')->insert([
            'firstname' => 'Abcd',
            'lastname' => 'abcd',
            'email' => 'subodhkadam0619@gmail.com',
            'password' => bcrypt('abcd123'),
            'status' => '1',
            'created_date' => date("Y-m-d H:i:s"),
            'fb_token' => 'null',
            'twitter_token' => 'null',
            'google_token' => 'null',
            'registration_method' => 'n',
            'role_id' => '4',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
            'remember_token'=>null,
        ]);

    }
}
