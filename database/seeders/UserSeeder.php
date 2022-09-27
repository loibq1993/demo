<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'student',
                    'email' => 'student@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => config('constants.roles.student')
                ],
                [
                    'name' => 'teacher',
                    'email' => 'teacher@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => config('constants.roles.teacher')
                ]
            ]
        );
    }
}
