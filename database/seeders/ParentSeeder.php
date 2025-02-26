<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parents')->insert([
            [
                'first_name' => 'George',
                'last_name' => 'Johnson',
                'email' => 'george.j@email.com',
                'phone' => '3456789012',
                'relationship' => 'Father',
            ],
            [
                'first_name' => 'Helen',
                'last_name' => 'Johnson',
                'email' => 'helen.j@email.com',
                'phone' => '4567890123',
                'relationship' => 'Mother',
            ],
            [
                'first_name' => 'Ian',
                'last_name' => 'Williams',
                'email' => 'ian.w@email.com',
                'phone' => '5678901234',
                'relationship' => 'Father',
            ],
            [
                'first_name' => 'Julia',
                'last_name' => 'Williams',
                'email' => 'julia.w@email.com',
                'phone' => '6789012345',
                'relationship' => 'Mother',
            ],
            [
                'first_name' => 'Kevin',
                'last_name' => 'Brown',
                'email' => 'kevin.b@email.com',
                'phone' => '7890123456',
                'relationship' => 'Father',
            ],
            [
                'first_name' => 'Laura',
                'last_name' => 'Brown',
                'email' => 'laura.b@email.com',
                'phone' => '8901234567',
                'relationship' => 'Mother',
            ],
        ]);

        DB::table('student_parents')->insert([
            ['student_id' => 1, 'parent_id' => 1, 'is_emergency_contact' => true],
            ['student_id' => 1, 'parent_id' => 2, 'is_emergency_contact' => false],
            ['student_id' => 2, 'parent_id' => 3, 'is_emergency_contact' => true],
            ['student_id' => 2, 'parent_id' => 4, 'is_emergency_contact' => false],
            ['student_id' => 3, 'parent_id' => 5, 'is_emergency_contact' => true],
            ['student_id' => 3, 'parent_id' => 6, 'is_emergency_contact' => false],
        ]);
    }
}
