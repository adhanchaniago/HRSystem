<?php

use Illuminate\Database\Seeder;

class InterviewTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interview_type')->insert([
            [
                'interview_type_id' => "ITY0001",
                'interview_type_name' => "Face to Face",
                'created_at' => now('Asia/Jakarta'),
                'updated_at' => now('Asia/Jakarta')
            ], [
                'interview_type_id' => "ITY0002",
                'interview_type_name' => "Online Interview",
                'created_at' => now('Asia/Jakarta'),
                'updated_at' => now('Asia/Jakarta')
            ]
        ]);
    }
}
