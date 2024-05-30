<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [ 'id'=>1,  'title' =>'user_access'],
            [ 'id'=>13, 'title' => 'user_create'],
            [ 'id'=>14, 'title' => 'create_issue'],
            [ 'id'=>15, 'title' => 'update_issue'],
            [ 'id'=>16, 'title' => 'accept_issue'],
            [ 'id'=>17, 'title' => 'delete_issue']
        ];
        Permission::insert($permissions);
    }
}
