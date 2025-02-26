<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert([
            [
                'name' => 'BSc in Physics',
                'department_id' => 1,
                'degree_type' => 'Bachelor',
                'description' => 'Comprehensive study of physical phenomena',
                'duration_years' => 4,
                'accreditation_status' => 'Accredited',
                'last_review_date' => '2022-05-15',
                'next_review_date' => '2027-05-15',
            ],
            [
                'name' => 'BSc in Biology',
                'department_id' => 2,
                'degree_type' => 'Bachelor',
                'description' => 'In-depth study of life sciences',
                'duration_years' => 4,
                'accreditation_status' => 'Accredited',
                'last_review_date' => '2021-11-30',
                'next_review_date' => '2026-11-30',
            ],
            [
                'name' => 'BA in English Literature',
                'department_id' => 3,
                'degree_type' => 'Bachelor',
                'description' => 'Exploration of literary traditions',
                'duration_years' => 3,
                'accreditation_status' => 'Accredited',
                'last_review_date' => '2023-01-20',
                'next_review_date' => '2028-01-20',
            ],
            [
                'name' => 'BSc in Computer Science',
                'department_id' => 4,
                'degree_type' => 'Bachelor',
                'description' => 'Study of computation and information processing',
                'duration_years' => 4,
                'accreditation_status' => 'Accredited',
                'last_review_date' => '2022-09-10',
                'next_review_date' => '2027-09-10',
            ],
            [
                'name' => 'BEng in Mechanical Engineering',
                'department_id' => 5,
                'degree_type' => 'Bachelor',
                'description' => 'Design and analysis of mechanical systems',
                'duration_years' => 4,
                'accreditation_status' => 'Accredited',
                'last_review_date' => '2023-03-05',
                'next_review_date' => '2028-03-05',
            ],
            [
                'name' => 'MD in Medicine',
                'department_id' => 6,
                'degree_type' => 'Doctorate',
                'description' => 'Professional degree in medicine',
                'duration_years' => 4,
                'accreditation_status' => 'Accredited',
                'last_review_date' => '2022-07-01',
                'next_review_date' => '2027-07-01',
            ],
        ]);
    }
}
