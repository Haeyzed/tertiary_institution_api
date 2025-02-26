<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
//    public function run(): void
//    {
//        // User::factory(10)->create();
//
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
//    }
    public function run(): void
    {
        $this->call([
            FacultySeeder::class,
            DepartmentSeeder::class,
            ProgramSeeder::class,
            CourseSeeder::class,
            LecturerSeeder::class,
            StudentSeeder::class,
            ParentSeeder::class,
            StaffSeeder::class,
            AcademicSessionSeeder::class,
            SemesterSeeder::class,
            AcademicCalendarSeeder::class,
            ClassSeeder::class,
            LessonSeeder::class,
            AssignmentSeeder::class,
            ExamSeeder::class,
            AttendanceSeeder::class,
            ResearchProjectSeeder::class,
            PublicationSeeder::class,
            GradeSeeder::class,
            TranscriptSeeder::class,
            CourseGradeSeeder::class,
            LibraryResourceSeeder::class,
            LibraryBorrowingSeeder::class,
            HostelSeeder::class,
            RoomSeeder::class,
            RoomAssignmentSeeder::class,
            FeeTypeSeeder::class,
            FeeStructureSeeder::class,
            StudentPaymentSeeder::class,
            ScholarshipSeeder::class,
            StudentScholarshipSeeder::class,
            AlumniSeeder::class,
            AlumniDonationSeeder::class,
            TimetableSlotSeeder::class,
            GradingScaleSeeder::class,
            CourseGradingPolicySeeder::class,
            CourseRegistrationSeeder::class,
            StudentOrganizationSeeder::class,
            StudentOrganizationMembershipSeeder::class,
            EventSeeder::class,
            DisciplinaryCaseSeeder::class,
            DisciplinaryActionSeeder::class,
            InternshipSeeder::class,
            InternshipReportSeeder::class,
            GraduationRequirementSeeder::class,
            StudentClearanceSeeder::class,
            CourseMaterialSeeder::class,
            StudentGroupSeeder::class,
            StudentGroupMemberSeeder::class,
            AcademicAdvisorSeeder::class,
            StudentAdvisorAssignmentSeeder::class,
            CurriculumVersionSeeder::class,
            EquipmentInventorySeeder::class,
            EquipmentBookingSeeder::class,
            AcademicPartnershipSeeder::class,
            StudentExchangeSeeder::class,
            GrantFundingSeeder::class,
            AcademicConferenceSeeder::class,
            ConferenceAttendeeSeeder::class,
            LmsCourseSeeder::class,
            StudentFeedbackSeeder::class,
        ]);
    }
}
