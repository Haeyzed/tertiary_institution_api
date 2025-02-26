<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lecturers')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@university.edu',
                'phone' => '1234567890',
                'date_of_birth' => '1975-05-15',
                'gender' => 'Male',
                'hire_date' => '2010-09-01',
                'employee_id' => 'L001',
                'highest_degree' => 'PhD',
                'specialization' => 'Quantum Physics',
                'research_interests' => 'Quantum computing, particle physics',
                'office_location' => 'Science Building, Room 101',
                'office_hours' => 'Mon, Wed 10:00-12:00',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@university.edu',
                'phone' => '2345678901',
                'date_of_birth' => '1980-08-22',
                'gender' => 'Female',
                'hire_date' => '2012-09-01',
                'employee_id' => 'L002',
                'highest_degree' => 'PhD',
                'specialization' => 'Molecular Biology',
                'research_interests' => 'Gene therapy, cancer research',
                'office_location' => 'Biology Lab, Room 205',
                'office_hours' => 'Tue, Thu 14:00-16:00',
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Johnson',
                'email' => 'robert.johnson@university.edu',
                'phone' => '3456789012',
                'date_of_birth' => '1978-03-10',
                'gender' => 'Male',
                'hire_date' => '2011-09-01',
                'employee_id' => 'L003',
                'highest_degree' => 'PhD',
                'specialization' => 'Modern Literature',
                'research_interests' => 'Postcolonial literature, digital humanities',
                'office_location' => 'Arts Building, Room 303',
                'office_hours' => 'Wed, Fri 11:00-13:00',
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Brown',
                'email' => 'emily.brown@university.edu',
                'phone' => '4567890123',
                'date_of_birth' => '1982-11-30',
                'gender' => 'Female',
                'hire_date' => '2013-09-01',
                'employee_id' => 'L004',
                'highest_degree' => 'PhD',
                'specialization' => 'Artificial Intelligence',
                'research_interests' => 'Machine learning, natural language processing',
                'office_location' => 'Computer Science Building, Room 404',
                'office_hours' => 'Mon, Thu 13:00-15:00',
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Davis',
                'email' => 'michael.davis@university.edu',
                'phone' => '5678901234',
                'date_of_birth' => '1976-07-18',
                'gender' => 'Male',
                'hire_date' => '2009-09-01',
                'employee_id' => 'L005',
                'highest_degree' => 'PhD',
                'specialization' => 'Robotics',
                'research_interests' => 'Autonomous systems, human-robot interaction',
                'office_location' => 'Engineering Building, Room 505',
                'office_hours' => 'Tue, Fri 09:00-11:00',
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Wilson',
                'email' => 'sarah.wilson@university.edu',
                'phone' => '6789012345',
                'date_of_birth' => '1979-04-05',
                'gender' => 'Female',
                'hire_date' => '2014-09-01',
                'employee_id' => 'L006',
                'highest_degree' => 'MD',
                'specialization' => 'Cardiology',
                'research_interests' => 'Heart disease prevention, cardiac imaging',
                'office_location' => 'Medical School, Room 606',
                'office_hours' => 'Mon, Wed 15:00-17:00',
            ],
        ]);

        DB::table('lecturer_departments')->insert([
            ['lecturer_id' => 1, 'department_id' => 1],
            ['lecturer_id' => 2, 'department_id' => 2],
            ['lecturer_id' => 3, 'department_id' => 3],
            ['lecturer_id' => 4, 'department_id' => 4],
            ['lecturer_id' => 5, 'department_id' => 5],
            ['lecturer_id' => 6, 'department_id' => 6],
        ]);
    }
}
