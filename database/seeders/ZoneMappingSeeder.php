<?php

namespace Database\Seeders;

use App\Models\ZoneMappingWithTO;
use Illuminate\Database\Seeder;

class ZoneMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $zone_mapping = [
            ['id'=>1, 'user_id'=>2, 'zone_id'=>59],
            ['id'=>2, 'user_id'=>3, 'zone_id'=>3],
            ['id'=>3, 'user_id'=>3, 'zone_id'=>6],
            ['id'=>4, 'user_id'=>4, 'zone_id'=>1],
            ['id'=>5, 'user_id'=>4, 'zone_id'=>2],
            ['id'=>6, 'user_id'=>5, 'zone_id'=>4],
            ['id'=>7, 'user_id'=>5, 'zone_id'=>5]
        ];
        ZoneMappingWithTO::insert($zone_mapping);
    }
}
