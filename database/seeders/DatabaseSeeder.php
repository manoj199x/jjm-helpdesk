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
        // \App\Models\User::factory(10)->create();
        $this->call([
//          PermissionTableSeeder::class,
            RoleTableSeeder::class,
            PermissionTableSeeder::class,
            UserTableSeeder::class,
            RoleUserTableSeeder::class,

            IssueTypesTableSeeder::class,
            SubIssueTypesTableSeeder::class,
            StatusTableSeeder::class,
            ZoneMappingSeeder::class
        ]);
    }
}
