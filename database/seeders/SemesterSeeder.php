<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semesters')->insert([
            [
                'name' => 'Fall 2023',
                'academic_session_id' => 1,
                'start_date' => '2023-09-01',
                'end_date' => '2023-12-20',
                'is_current' => true,
            ],
            [
                'name' => 'Spring 2024',
                'academic_session_id' => 1,
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'is_current' => false,
            ],
            [
                'name' => 'Summer 2024',
                'academic_session_id' => 1,
                'start_date' => '2024-06-01',
                'end_date' => '2024-08-15',
                'is_current' => false,
            ],
            [
                'name' => 'Fall 2024',
                'academic_session_id' => 3,
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-20',
                'is_current' => false,
            ],
        ]);
    }
}
