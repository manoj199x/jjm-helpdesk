<?php

namespace Database\Seeders;

use App\Models\IssueType;
use Illuminate\Database\Seeder;

class IssueTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $issue_types = [
            [
                'id'    => 1,
                'short_name'    => 'SM',
                'name' => 'SMT',
            ],
            [
                'id'    => 2,
                'short_name'    => 'IM',
                'name' => 'IMIS',
            ],
            [
                'id'    => 3,
                'short_name'    => 'EB',
                'name' => 'Ebill',
            ],
            [
                'id'    => 4,
                'short_name'    => 'OT',
                'name' => 'Other',
            ],
            
        ];

        IssueType::insert($issue_types);
    }
}
