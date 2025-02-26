<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('academic_sessions')->insert([
            [
                'name' => '2023-2024',
                'start_date' => '2023-09-01',
                'end_date' => '2024-08-31',
                'is_current' => true,
            ],
            [
                'name' => '2022-2023',
                'start_date' => '2022-09-01',
                'end_date' => '2023-08-31',
                'is_current' => false,
            ],
            [
                'name' => '2024-2025',
                'start_date' => '2024-09-01',
                'end_date' => '2025-08-31',
                'is_current' => false,
            ],
        ]);
    }
}
