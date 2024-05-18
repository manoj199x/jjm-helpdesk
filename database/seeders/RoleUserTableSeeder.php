<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use Illuminate\Database\Seeder;
use App\Models\User;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::findOrFail(1)->roles()->sync(1);
        // User::findOrFail(2)->roles()->sync(2);

        $role_users = [
            [
                'id'    => 1,
                'user_id' => '2',
                'role_id' => '4',

            ],
            [
                'id'    => 2,
                'user_id' => '3',
                'role_id' => '4',

            ],
            [
                'id'    => 3,
                'user_id' => '4',
                'role_id' => '4',

            ],
            [
                'id'    => 4,
                'user_id' => '5',
                'role_id' => '4',

            ],
            [
                'id'    => 5,
                'user_id' => '6',
                'role_id' => '3',

            ],
            [
                'id'    => 6,
                'user_id' => '7',
                'role_id' => '3',

            ],
            [
                'id'    => 7,
                'user_id' => '8',
                'role_id' => '3',

            ],
            [
                'id'    => 8,
                'user_id' => '1',
                'role_id' => '1',

            ],
            [
                'id'    => 9,
                'user_id' => '9',
                'role_id' => '1',

            ]
            
        ];

        RoleUser::insert($role_users);
    }
}
