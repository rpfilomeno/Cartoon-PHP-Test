<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_ENV') != 'production')
        {
            DB::table('users')->insert([
                'name' => 'demo',
                'email' => 'demo', //test email: cartoontests@mailinator.com
                'password' => Hash::make('pwd1234'),
            ]);
        }
    }
}
