<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Department::insert([
            ['department_name' => 'College of Humanities and Social Sciences'],
            ['department_name' => 'Department of Computer Studies'],
            ['department_name' => 'College of Business and Accountancy'],
            ['department_name' => 'College of Education'],
        ]);
    }
}
