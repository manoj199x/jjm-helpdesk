<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $document_types = [
            [
                'id' => 1,
                'title' => 'PDF'
            ]
            ];
        Document::insert($document_types);
    }
}