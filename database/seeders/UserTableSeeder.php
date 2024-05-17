<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'username'          => 'admin',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Ankur Talukdar',
                'email'          => 'user@user.com',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'Prasanta Deka',
                'email'          => 'user@user.com',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'Felix Deori',
                'email'          => 'user@user.com',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'Chiranjit Choudhury',
                'email'          => 'user@user.com',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 6,
                'name'           => 'Kaushik Kalita',
                'email'          => 'user@user.com',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 7,
                'name'           => 'Amanur Rahman',
                'email'          => 'user@user.com',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 8,
                'name'           => 'Hemanta Sarma',
                'email'          => 'user@user.com',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 8,
                'name'           => '',
                'email'          => 'user@user.com',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ]
        ];

        User::insert($users);
    }
}
