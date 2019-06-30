<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role')->insert([
            [
                'role_id' => "ROLE001",
                'role_name' => "Recruitment Unit",
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'role_id' => "ROLE002",
                'role_name' => "Applicant",
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
