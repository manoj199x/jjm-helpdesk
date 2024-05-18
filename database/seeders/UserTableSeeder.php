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
                'name'           => 'System Admin',
                'email'          => 'admin@admin.com',
                'username'          => 'sysadmin@helpdesk',
                'password'       => bcrypt('password#123'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Ankur Talukdar',
                'email'          => 'user@user.com',
                'username'          => 'ankur@helpdesk',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'Prasanta Deka',
                'email'          => 'user@user.com',
                'username'          => 'prsanta@helpdesk',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'Felix Deori',
                'email'          => 'user@user.com',
                'username'          => 'felix@helpdesk',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 5,
                'name'           => 'Chiranjit Choudhury',
                'email'          => 'user@user.com',
                'username'          => 'chiranjit@helpdesk',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 6,
                'name'           => 'Kaushik Kalita',
                'email'          => 'kaushik@helpdesk',
                'username'          => 'user',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 7,
                'name'           => 'Amanur Rahman',
                'email'          => 'amanur@helpdesk',
                'username'          => 'amanur@helpdesk',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 8,
                'name'           => 'Hemanta Sarma',
                'email'          => 'hemanta@helpdesk',
                'username'          => 'hemanta@helpdesk',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 9,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'username'          => 'admin@helpdesk',
                'password'       => bcrypt('password@123'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
