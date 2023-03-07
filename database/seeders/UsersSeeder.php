<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => 'jose512', 'password' => Hash::make('123456'), 'last_login' => null, 'is_active' => true, 'role' => 'manager'],
            ['username' => 'cleo_thod', 'password' => Hash::make('123456'), 'last_login' => null, 'is_active' => true, 'role' => 'agent'],
        ]);
    }
}
