<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staff')->insert([
            [
                'first_name' => 'Oliver',
                'last_name' => 'Wilson',
                'email' => 'oliver.wilson@university.edu',
                'phone' => '9012345678',
                'date_of_birth' => '1985-09-18',
                'gender' => 'Male',
                'hire_date' => '2015-01-15',
                'employee_id' => 'A001',
                'department_id' => 1,
                'role' => 'Administrative Assistant',
                'is_active' => true,
                'highest_education' => 'Bachelor\'s Degree',
                'specialization' => 'Business Administration',
                'contract_type' => 'Full-time',
            ],
            [
                'first_name' => 'Sophia',
                'last_name' => 'Moore',
                'email' => 'sophia.moore@university.edu',
                'phone' => '0123456789',
                'date_of_birth' => '1982-12-05',
                'gender' => 'Female',
                'hire_date' => '2014-06-01',
                'employee_id' => 'A002',
                'department_id' => 2,
                'role' => 'Lab Technician',
                'is_active' => true,
                'highest_education' => 'Master\'s Degree',
                'specialization' => 'Biotechnology',
                'contract_type' => 'Full-time',
            ],
            [
                'first_name' => 'Liam',
                'last_name' => 'Taylor',
                'email' => 'liam.taylor@university.edu',
                'phone' => '1234567890',
                'date_of_birth' => '1980-03-22',
                'gender' => 'Male',
                'hire_date' => '2013-09-01',
                'employee_id' => 'A003',
                'department_id' => 3,
                'role' => 'Department Coordinator',
                'is_active' => true,
                'highest_education' => 'Bachelor\'s Degree',
                'specialization' => 'English',
                'contract_type' => 'Full-time',
            ],
            [
                'first_name' => 'Ava',
                'last_name' => 'Anderson',
                'email' => 'ava.anderson@university.edu',
                'phone' => '2345678901',
                'date_of_birth' => '1988-07-14',
                'gender' => 'Female',
                'hire_date' => '2016-03-15',
                'employee_id' => 'A004',
                'department_id' => 4,
                'role' => 'IT Support Specialist',
                'is_active' => true,
                'highest_education' => 'Bachelor\'s Degree',
                'specialization' => 'Information Technology',
                'contract_type' => 'Full-time',
            ],
            [
                'first_name' => 'Noah',
                'last_name' => 'Thomas',
                'email' => 'noah.thomas@university.edu',
                'phone' => '3456789012',
                'date_of_birth' => '1983-11-09',
                'gender' => 'Male',
                'hire_date' => '2015-08-01',
                'employee_id' => 'A005',
                'department_id' => 5,
                'role' => 'Lab Manager',
                'is_active' => true,
                'highest_education' => 'Master\'s Degree',
                'specialization' => 'Mechanical Engineering',
                'contract_type' => 'Full-time',
            ],
            [
                'first_name' => 'Emma',
                'last_name' => 'Jackson',
                'email' => 'emma.jackson@university.edu',
                'phone' => '4567890123',
                'date_of_birth' => '1986-05-27',
                'gender' => 'Female',
                'hire_date' => '2017-01-10',
                'employee_id' => 'A006',
                'department_id' => 6,
                'role' => 'Clinical Coordinator',
                'is_active' => true,
                'highest_education' => 'Bachelor\'s Degree',
                'specialization' => 'Nursing',
                'contract_type' => 'Full-time',
            ],
        ]);

        // Update foreign keys for deans and department heads
        DB::table('faculties')->whereIn('id', [1, 2, 3, 4])->update([
            1 => ['dean_id' => 1],
            2 => ['dean_id' => 3],
            3 => ['dean_id' => 4],
            4 => ['dean_id' => 6],
        ]);

        DB::table('departments')->whereIn('id', [1, 2, 3, 4, 5, 6])->update([
            1 => ['head_id' => 1],
            2 => ['head_id' => 2],
            3 => ['head_id' => 3],
            4 => ['head_id' => 4],
            5 => ['head_id' => 5],
            6 => ['head_id' => 6],
        ]);

        DB::table('programs')->whereIn('id', [1, 2, 3, 4, 5, 6])->update([
            1 => ['coordinator_id' => 1],
            2 => ['coordinator_id' => 2],
            3 => ['coordinator_id' => 3],
            4 => ['coordinator_id' => 4],
            5 => ['coordinator_id' => 5],
            6 => ['coordinator_id' => 6],
        ]);
    }
}
