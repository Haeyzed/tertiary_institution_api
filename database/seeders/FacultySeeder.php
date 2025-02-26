<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculties')->insert([
            [
                'name' => 'Faculty of Science',
                'description' => 'Dedicated to scientific research and education',
                'established_date' => '1960-09-01',
                'website' => 'https://science.university.edu',
            ],
            [
                'name' => 'Faculty of Arts',
                'description' => 'Exploring creativity and cultural studies',
                'established_date' => '1965-09-01',
                'website' => 'https://arts.university.edu',
            ],
            [
                'name' => 'Faculty of Engineering',
                'description' => 'Innovating technology and design',
                'established_date' => '1970-09-01',
                'website' => 'https://engineering.university.edu',
            ],
            [
                'name' => 'Faculty of Medicine',
                'description' => 'Advancing healthcare and medical research',
                'established_date' => '1975-09-01',
                'website' => 'https://medicine.university.edu',
            ],
        ]);
    }
}
