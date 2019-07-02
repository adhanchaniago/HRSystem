<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_type')->insert([
            [
                'document_type_id' => "DTY0001",
                'document_type_name' => "CV",
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'document_type_id' => "DTY0002",
                'document_type_name' => "Certificate",
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'document_type_id' => "DTY0003",
                'document_type_name' => "Test Answers",
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'document_type_id' => "DTY0004",
                'document_type_name' => "Test Questions",
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
