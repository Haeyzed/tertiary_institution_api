<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'email' => 'alice.j@university.edu',
                'phone' => '7890123456',
                'date_of_birth' => '2000-07-12',
                'gender' => 'Female',
                'student_id' => 'S001',
                'enrollment_year' => 2020,
                'program_id' => 1,
                'current_grade_id' => 1,
                'nationality' => 'USA',
                'admission_type' => 'Regular',
                'admission_score' => 95.5,
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Williams',
                'email' => 'bob.w@university.edu',
                'phone' => '8901234567',
                'date_of_birth' => '2001-03-25',
                'gender' => 'Male',
                'student_id' => 'S002',
                'enrollment_year' => 2020,
                'program_id' => 2,
                'current_grade_id' => 1,
                'nationality' => 'Canada',
                'admission_type' => 'Regular',
                'admission_score' => 88.0,
            ],
            [
                'first_name' => 'Charlie',
                'last_name' => 'Brown',
                'email' => 'charlie.b@university.edu',
                'phone' => '9012345678',
                'date_of_birth' => '1999-11-30',
                'gender' => 'Male',
                'student_id' => 'S003',
                'enrollment_year' => 2019,
                'program_id' => 3,
                'current_grade_id' => 2,
                'nationality' => 'UK',
                'admission_type' => 'Transfer',
                'admission_score' => 92.0,
            ],
            [
                'first_name' => 'Diana',
                'last_name' => 'Miller',
                'email' => 'diana.m@university.edu',
                'phone' => '0123456789',
                'date_of_birth' => '2000-09-18',
                'gender' => 'Female',
                'student_id' => 'S004',
                'enrollment_year' => 2020,
                'program_id' => 4,
                'current_grade_id' => 1,
                'nationality' => 'Australia',
                'admission_type' => 'Regular',
                'admission_score' => 97.5,
            ],
            [
                'first_name' => 'Edward',
                'last_name' => 'Taylor',
                'email' => 'edward.t@university.edu',
                'phone' => '1234567890',
                'date_of_birth' => '1999-05-07',
                'gender' => 'Male',
                'student_id' => 'S005',
                'enrollment_year' => 2019,
                'program_id' => 5,
                'current_grade_id' => 2,
                'nationality' => 'Germany',
                'admission_type' => 'International',
                'admission_score' => 90.0,
            ],
            [
                'first_name' => 'Fiona',
                'last_name' => 'Anderson',
                'email' => 'fiona.a@university.edu',
                'phone' => '2345678901',
                'date_of_birth' => '1998-12-15',
                'gender' => 'Female',
                'student_id' => 'S006',
                'enrollment_year' => 2018,
                'program_id' => 6,
                'current_grade_id' => 3,
                'nationality' => 'France',
                'admission_type' => 'Regular',
                'admission_score' => 94.5,
            ],
        ]);
    }
}
