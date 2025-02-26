<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name' => 'Department of Physics',
                'faculty_id' => 1,
                'description' => 'Studying the fundamental nature of the universe',
                'established_date' => '1960-09-01',
                'research_focus' => 'Quantum mechanics, astrophysics',
                'budget' => 5000000.00,
            ],
            [
                'name' => 'Department of Biology',
                'faculty_id' => 1,
                'description' => 'Exploring life and living organisms',
                'established_date' => '1962-09-01',
                'research_focus' => 'Genetics, ecology',
                'budget' => 4500000.00,
            ],
            [
                'name' => 'Department of Literature',
                'faculty_id' => 2,
                'description' => 'Analyzing and creating literary works',
                'established_date' => '1965-09-01',
                'research_focus' => 'Contemporary literature, creative writing',
                'budget' => 3000000.00,
            ],
            [
                'name' => 'Department of Computer Science',
                'faculty_id' => 3,
                'description' => 'Advancing computational theory and practice',
                'established_date' => '1980-09-01',
                'research_focus' => 'Artificial intelligence, data science',
                'budget' => 6000000.00,
            ],
            [
                'name' => 'Department of Mechanical Engineering',
                'faculty_id' => 3,
                'description' => 'Designing and analyzing mechanical systems',
                'established_date' => '1970-09-01',
                'research_focus' => 'Robotics, sustainable energy',
                'budget' => 5500000.00,
            ],
            [
                'name' => 'Department of Internal Medicine',
                'faculty_id' => 4,
                'description' => 'Comprehensive study of adult diseases',
                'established_date' => '1975-09-01',
                'research_focus' => 'Cardiology, oncology',
                'budget' => 7000000.00,
            ],
        ]);
    }
}
