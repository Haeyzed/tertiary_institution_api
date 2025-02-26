<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'code' => 'PHYS101',
                'title' => 'Introduction to Physics',
                'description' => 'Fundamental concepts of physics',
                'credit_hours' => 3,
                'department_id' => 1,
                'syllabus' => 'Basic mechanics, thermodynamics, and electromagnetism',
                'learning_outcomes' => 'Understand basic physical laws and principles',
                'is_elective' => false,
            ],
            [
                'code' => 'BIOL101',
                'title' => 'Introduction to Biology',
                'description' => 'Basic principles of biology',
                'credit_hours' => 3,
                'department_id' => 2,
                'syllabus' => 'Cell biology, genetics, and evolution',
                'learning_outcomes' => 'Comprehend fundamental biological concepts',
                'is_elective' => false,
            ],
            [
                'code' => 'ENGL101',
                'title' => 'Introduction to Literature',
                'description' => 'Survey of literary genres',
                'credit_hours' => 3,
                'department_id' => 3,
                'syllabus' => 'Poetry, prose, and drama analysis',
                'learning_outcomes' => 'Develop critical reading and writing skills',
                'is_elective' => false,
            ],
            [
                'code' => 'COMP101',
                'title' => 'Introduction to Programming',
                'description' => 'Basics of computer programming',
                'credit_hours' => 3,
                'department_id' => 4,
                'syllabus' => 'Programming fundamentals, data structures, and algorithms',
                'learning_outcomes' => 'Write basic computer programs',
                'is_elective' => false,
            ],
            [
                'code' => 'MECH101',
                'title' => 'Engineering Mechanics',
                'description' => 'Principles of mechanical engineering',
                'credit_hours' => 3,
                'department_id' => 5,
                'syllabus' => 'Statics, dynamics, and material science',
                'learning_outcomes' => 'Apply mechanical principles to simple systems',
                'is_elective' => false,
            ],
            [
                'code' => 'MED101',
                'title' => 'Human Anatomy',
                'description' => 'Study of human body structure',
                'credit_hours' => 4,
                'department_id' => 6,
                'syllabus' => 'Skeletal, muscular, and nervous systems',
                'learning_outcomes' => 'Identify major anatomical structures',
                'is_elective' => false,
            ],
        ]);

        DB::table('course_prerequisites')->insert([
            ['course_id' => 2, 'prerequisite_id' => 1],
            ['course_id' => 5, 'prerequisite_id' => 1],
        ]);

        DB::table('program_courses')->insert([
            ['program_id' => 1, 'course_id' => 1, 'is_required' => true],
            ['program_id' => 2, 'course_id' => 2, 'is_required' => true],
            ['program_id' => 3, 'course_id' => 3, 'is_required' => true],
            ['program_id' => 4, 'course_id' => 4, 'is_required' => true],
            ['program_id' => 5, 'course_id' => 5, 'is_required' => true],
            ['program_id' => 6, 'course_id' => 6, 'is_required' => true],
        ]);
    }
}
