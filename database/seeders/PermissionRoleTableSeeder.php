<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin_permissions = Permission::all();
        // Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        
        // $user_permissions = $admin_permissions->filter(function ($permission) {
        //     return substr($permission->title, 0, 5) != 'user_';
        // });

        // Role::findOrFail(2)->permissions()->sync($user_permissions);
        $permission_roles = [
        
        ['id'=>1, 'role_id'=>1, 'permission_id'=>1],
        ['id'=>2, 'role_id'=>1, 'permission_id'=> 13],
        ['id'=>3, 'role_id'=>2, 'permission_id'=>14],
        ['id'=>4, 'role_id'=>3, 'permission_id'=>15],
        ['id'=>5, 'role_id'=>4, 'permission_id'=>15],
        ['id'=>6, 'role_id'=>4, 'permission_id'=>16],
        ['id'=>7, 'role_id'=>2, 'permission_id'=>17]];

        PermissionRole::insert($permission_roles);
    }
}
