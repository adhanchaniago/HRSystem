<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('department')->insert([

            [
                "department_id"=> "DPT0001",
                "department_name"=> "Research and Development",
            ],
            [
                "department_id"=> "DPT0002",
                "department_name"=> "Human Resources",
            ],
            [
                "department_id"=> "DPT0003",
                "department_name"=> "Research and Development",
            ],
            [
                "department_id"=> "DPT0004",
                "department_name"=> "Marketing",
            ],
            [
                "department_id"=> "DPT0005",
                "department_name"=> "Legal",
            ],
            [
                "department_id"=> "DPT0006",
                "department_name"=> "Support",
            ],
            [
                "department_id"=> "DPT0007",
                "department_name"=> "Services",
            ],
            [
                "department_id"=> "DPT0008",
                "department_name"=> "IT",
            ]
            
        ]);
    }
}
