<?php

namespace Database\Seeders;

use App\Models\SubIssueType;
use Illuminate\Database\Seeder;

class SubIssueTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $subissue_types = [
            ['id'=>1, 'issue_type_id'=>2, 'name'=>'Physical program'],
            ['id'=>2, 'issue_type_id'=>2, 'name'=>'Financial Program'],
            ['id'=>3, 'issue_type_id'=>2, 'name'=>'Scheme Entry'],
            ['id'=>4, 'issue_type_id'=>2, 'name'=>'Cost Verification'],
            ['id'=>5, 'issue_type_id'=>2, 'name'=>'PFMS Voucher Mismatch/Deletion'],
            ['id'=>6, 'issue_type_id'=>2, 'name'=>'If Other ,Then Describe'],
            ['id'=>7, 'issue_type_id'=>1, 'name'=>'Online work Allotment'],
            ['id'=>8, 'issue_type_id'=>1, 'name'=>'Fund Demand'],
            ['id'=>9, 'issue_type_id'=>1, 'name'=>'Activity Report'],
            ['id'=>10,'issue_type_id'=>3, 'name'=>'Contractor Signup registration/Approval'],
            ['id'=>11,'issue_type_id'=>3, 'name'=>'E-MD Contractor'],
            ['id'=>12,'issue_type_id'=>3, 'name'=>'E-Bill Contractors\r\n'],
            ['id'=>13,'issue_type_id'=>3, 'name'=>'E-MB Official'],
            ['id'=>14,'issue_type_id'=>3, 'name'=>'E-Bill Official'],
            ['id'=>15,'issue_type_id'=>3, 'name'=>'Ebill Final Bill']
        ];
        SubIssueType::insert($subissue_types);
    }
}
