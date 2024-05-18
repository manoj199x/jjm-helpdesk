<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = [
            ['id'=>1, 'name'=>'Accepted'],
            ['id'=>2, 'name'=>'Forwarded'],
            ['id'=>3, 'name'=>'Complete'],
            ['id'=>4, 'name'=>'Created']
        ];
        
        Status::insert($statuses);

    }
}
