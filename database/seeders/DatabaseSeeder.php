<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            RoleUserTableSeeder::class,
            PermissionRoleTableSeeder::class,
            IssueTypesTableSeeder::class,
            SubIssueTypesTableSeeder::class,
            StatusTableSeeder::class,
            ZoneMappingSeeder::class,
            DocumentTableSeeder::class
        ]);
    }
}
