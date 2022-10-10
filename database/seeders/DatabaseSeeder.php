<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail',
                'password' => Hash::make('123456'),
                'address' => '180 Cao Lỗ',
                'phone' => '0123456789',
                'role' => '1',
                'status' => '1',
            ],
            [
                'name' => 'User1',
                'email' => 'user1@gmail',
                'password' => Hash::make('123456'),
                'address' => '180 Cao Lỗ',
                'phone' => '0123456789',
                'role' => '0',
                'status' => '1',
            ]
        ]);
    }
}
