<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Finance
        Schema::create('fee_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fee_type_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['fee_type_id', 'program_id', 'academic_session_id']);
            $table->foreign('fee_type_id')->references('id')->on('fee_types');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
        });

        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('fee_structure_id');
            $table->decimal('amount_paid', 10, 2);
            $table->date('payment_date');
            $table->string('payment_method', 50);
            $table->string('transaction_id', 100)->unique();
            $table->string('status', 20);
            $table->string('receipt_number', 50)->unique();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('fee_structure_id')->references('id')->on('fee_structures');
        });

        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('academic_session_id');
            $table->text('criteria')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
        });

        Schema::create('student_scholarships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('scholarship_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->date('award_date');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(
                ['student_id', 'scholarship_id', 'academic_session_id'],
                'stu_schlrshp_stuId_schlrId_sessId_unique'
            );
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('scholarship_id')->references('id')->on('scholarships');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
        });

        // Alumni
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->unique();
            $table->integer('graduation_year');
            $table->string('current_employer', 100)->nullable();
            $table->string('job_title', 100)->nullable();
            $table->string('linkedin_profile', 200)->nullable();
            $table->boolean('is_donor')->default(false);
            $table->date('last_contact_date')->nullable();
            $table->boolean('alumni_association_member')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('alumni_donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumni_id');
            $table->decimal('amount', 10, 2);
            $table->date('donation_date');
            $table->string('purpose', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('alumni_id')->references('id')->on('alumni');
        });

        // Timetable
        Schema::create('timetable_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->integer('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('room_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('room_id')->references('id')->on('rooms');
        });

        // Grading Policy
        Schema::create('grading_scales', function (Blueprint $table) {
            $table->id();
            $table->string('grade', 2);
            $table->decimal('min_score', 5, 2);
            $table->decimal('max_score', 5, 2);
            $table->decimal('grade_point', 3, 2);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('course_grading_policies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('component', 50);
            $table->decimal('weight', 3, 2);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['course_id', 'component']);
            $table->foreign('course_id')->references('id')->on('courses');
        });

        // Course Registration
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->unsignedBigInteger('semester_id');
            $table->date('registration_date');
            $table->string('status', 20)->default('Registered');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(
                ['student_id', 'course_id', 'academic_session_id', 'semester_id'],
                'crs_reg_stu_crs_sess_sem_unique'
            );
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
            $table->foreign('semester_id')->references('id')->on('semesters');
        });

        // Extracurricular Activities
        Schema::create('student_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('faculty_advisor_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('faculty_advisor_id')->references('id')->on('lecturers');
        });

        Schema::create('student_organization_memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('organization_id');
            $table->string('role', 50)->nullable();
            $table->date('join_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(
                ['student_id', 'organization_id'],
                'stu_org_mem_stu_org_unique'
            );
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('organization_id')->references('id')->on('student_organizations');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location', 100)->nullable();
            $table->unsignedBigInteger('organizer_id')->nullable();
            $table->integer('max_participants')->nullable();
            $table->date('registration_deadline')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('organizer_id')->references('id')->on('student_organizations');
        });

        // Disciplinary Records
        Schema::create('disciplinary_cases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('reported_by');
            $table->date('incident_date');
            $table->text('description');
            $table->string('severity', 20);
            $table->string('status', 20)->default('Open');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('reported_by')->references('id')->on('staff');
        });

        Schema::create('disciplinary_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id');
            $table->string('action_taken', 100);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('case_id')->references('id')->on('disciplinary_cases');
        });

        // Internships and Industrial Training
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('company_name', 100);
            $table->string('position', 100);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('supervisor_name', 100)->nullable();
            $table->string('supervisor_email', 100)->nullable();
            $table->decimal('stipend', 8, 2)->nullable();
            $table->integer('performance_rating')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('internship_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('internship_id');
            $table->date('report_date');
            $table->text('content');
            $table->text('feedback')->nullable();
            $table->string('grade', 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('internship_id')->references('id')->on('internships');
        });

        // Certification and Clearance
        Schema::create('graduation_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->string('requirement_type', 100);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['program_id', 'requirement_type']);
            $table->foreign('program_id')->references('id')->on('programs');
        });

        Schema::create('student_clearances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('requirement_id');
            $table->date('clearance_date');
            $table->unsignedBigInteger('cleared_by');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['student_id', 'requirement_id']);
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('requirement_id')->references('id')->on('graduation_requirements');
            $table->foreign('cleared_by')->references('id')->on('staff');
        });

        // Additional tables
        Schema::create('course_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->string('file_url', 200)->nullable();
            $table->timestamp('upload_date')->useCurrent();
            $table->string('material_type', 50);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::create('student_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('course_id')->nullable();
            $table->date('created_date');
            $table->text('purpose')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::create('student_group_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('student_id');
            $table->string('role', 50)->nullable();
            $table->date('join_date');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['group_id', 'student_id']);
            $table->foreign('group_id')->references('id')->on('student_groups');
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('academic_advisors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lecturer_id');
            $table->unsignedBigInteger('department_id');
            $table->integer('max_advisees')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['lecturer_id', 'department_id']);
            $table->foreign('lecturer_id')->references('id')->on('lecturers');
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::create('student_advisor_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('advisor_id');
            $table->date('assignment_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(
                ['student_id', 'advisor_id', 'assignment_date'],
                'stu_adv_assign_unique'
            );
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('advisor_id')->references('id')->on('academic_advisors');
        });

        Schema::create('curriculum_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->string('version_number', 20);
            $table->date('effective_from');
            $table->date('effective_to')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('approval_date');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['program_id', 'version_number']);
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('approved_by')->references('id')->on('staff');
        });

        Schema::create('equipment_inventory', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('equipment_type', 50);
            $table->string('serial_number', 100)->unique()->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('last_maintenance_date')->nullable();
            $table->string('condition', 50)->nullable();
            $table->string('location', 100)->nullable();
            $table->unsignedBigInteger('responsible_staff_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('responsible_staff_id')->references('id')->on('staff');
        });

        Schema::create('equipment_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('booked_by_id');
            $table->string('booked_by_type', 20);
            $table->dateTime('booking_start');
            $table->dateTime('booking_end');
            $table->text('purpose')->nullable();
            $table->string('status', 20)->default('Pending');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('equipment_id')->references('id')->on('equipment_inventory');
        });

        Schema::create('academic_partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('partner_institution', 200);
            $table->string('partnership_type', 100);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->string('contact_person', 100)->nullable();
            $table->string('contact_email', 100)->nullable();
            $table->string('status', 50);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('student_exchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('partnership_id');
            $table->unsignedBigInteger('home_program_id');
            $table->string('host_institution', 200);
            $table->date('exchange_start_date');
            $table->date('exchange_end_date');
            $table->string('status', 50);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('partnership_id')->references('id')->on('academic_partnerships');
            $table->foreign('home_program_id')->references('id')->on('programs');
        });

        Schema::create('grants_and_funding', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('funding_body', 100);
            $table->string('grant_type', 50);
            $table->decimal('amount', 12, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('principal_investigator_id')->nullable();
            $table->string('status', 50);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('principal_investigator_id')->references('id')->on('lecturers');
        });

        Schema::create('academic_conferences', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location', 100)->nullable();
            $table->string('organizer', 100)->nullable();
            $table->string('website', 200)->nullable();
            $table->date('registration_deadline')->nullable();
            $table->date('abstract_submission_deadline')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('conference_attendees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conference_id');
            $table->unsignedBigInteger('attendee_id');
            $table->string('attendee_type', 20);
            $table->string('presentation_title', 200)->nullable();
            $table->boolean('is_presenter')->default(false);
            $table->date('registration_date');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('conference_id')->references('id')->on('academic_conferences');
        });

        Schema::create('lms_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('lms_course_id', 100);
            $table->string('lms_url', 200);
            $table->timestamp('last_synced')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['course_id', 'lms_course_id']);
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::create('student_feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->date('submission_date');
            $table->integer('teaching_quality');
            $table->integer('course_content');
            $table->integer('learning_resources');
            $table->integer('overall_satisfaction');
            $table->text('comments')->nullable();
            $table->boolean('is_anonymous')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
        });

        Schema::create('graduation_ceremonies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_session_id');
            $table->date('ceremony_date');
            $table->string('venue', 100);
            $table->string('guest_speaker', 100)->nullable();
            $table->integer('total_graduates')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
        });

        Schema::create('graduate_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('graduation_ceremony_id');
            $table->unsignedBigInteger('program_id');
            $table->decimal('final_gpa', 3, 2);
            $table->string('honors', 50)->nullable();
            $table->string('thesis_title', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['student_id', 'graduation_ceremony_id']);
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('graduation_ceremony_id')->references('id')->on('graduation_ceremonies');
            $table->foreign('program_id')->references('id')->on('programs');
        });

        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('blood_type', 5)->nullable();
            $table->text('allergies')->nullable();
            $table->text('chronic_conditions')->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_phone', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('medical_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->dateTime('visit_date');
            $table->text('reason')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 100);
            $table->string('job_title', 100);
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->date('application_deadline')->nullable();
            $table->string('contact_email', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('career_workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->dateTime('date');
            $table->string('location', 100)->nullable();
            $table->integer('max_participants')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('workshop_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workshop_id');
            $table->unsignedBigInteger('student_id');
            $table->dateTime('registration_date');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['workshop_id', 'student_id']);
            $table->foreign('workshop_id')->references('id')->on('career_workshops');
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('it_assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_type', 50);
            $table->string('asset_tag', 50)->unique();
            $table->string('model', 100)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('last_maintenance_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('it_support_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requester_id');
            $table->string('requester_type', 20);
            $table->text('issue_description');
            $table->string('priority', 20);
            $table->string('status', 20)->default('Open');
            $table->timestamp('resolved_at')->nullable();
            $table->text('resolution_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('curriculum_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->date('review_date');
            $table->unsignedBigInteger('reviewer_id');
            $table->text('recommendations')->nullable();
            $table->string('status', 20);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('reviewer_id')->references('id')->on('lecturers');
        });

        Schema::create('course_updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->date('update_date');
            $table->text('changes');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('approval_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('approved_by')->references('id')->on('lecturers');
        });

        Schema::create('student_complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('complaint_type', 50);
            $table->text('description');
            $table->timestamp('submission_date')->useCurrent();
            $table->string('status', 20)->default('Pending');
            $table->text('resolution')->nullable();
            $table->unsignedBigInteger('resolved_by')->nullable();
            $table->timestamp('resolution_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('resolved_by')->references('id')->on('staff');
        });

        Schema::create('student_counseling_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('counselor_id');
            $table->dateTime('session_date');
            $table->text('notes')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('counselor_id')->references('id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_counseling_sessions');
        Schema::dropIfExists('student_complaints');
        Schema::dropIfExists('course_updates');
        Schema::dropIfExists('curriculum_reviews');
        Schema::dropIfExists('it_support_tickets');
        Schema::dropIfExists('it_assets');
        Schema::dropIfExists('workshop_registrations');
        Schema::dropIfExists('career_workshops');
        Schema::dropIfExists('job_postings');
        Schema::dropIfExists('medical_visits');
        Schema::dropIfExists('health_records');
        Schema::dropIfExists('graduate_list');
        Schema::dropIfExists('graduation_ceremonies');
        Schema::dropIfExists('student_feedback');
        Schema::dropIfExists('lms_courses');
        Schema::dropIfExists('conference_attendees');
        Schema::dropIfExists('academic_conferences');
        Schema::dropIfExists('grants_and_funding');
        Schema::dropIfExists('student_exchanges');
        Schema::dropIfExists('academic_partnerships');
        Schema::dropIfExists('equipment_bookings');
        Schema::dropIfExists('equipment_inventory');
        Schema::dropIfExists('curriculum_versions');
        Schema::dropIfExists('student_advisor_assignments');
        Schema::dropIfExists('academic_advisors');
        Schema::dropIfExists('student_group_members');
        Schema::dropIfExists('student_groups');
        Schema::dropIfExists('course_materials');
        Schema::dropIfExists('student_clearances');
        Schema::dropIfExists('graduation_requirements');
        Schema::dropIfExists('internship_reports');
        Schema::dropIfExists('internships');
        Schema::dropIfExists('disciplinary_actions');
        Schema::dropIfExists('disciplinary_cases');
        Schema::dropIfExists('events');
        Schema::dropIfExists('student_organization_memberships');
        Schema::dropIfExists('student_organizations');
        Schema::dropIfExists('course_registrations');
        Schema::dropIfExists('course_grading_policies');
        Schema::dropIfExists('grading_scales');
        Schema::dropIfExists('timetable_slots');
        Schema::dropIfExists('alumni_donations');
        Schema::dropIfExists('alumni');
        Schema::dropIfExists('student_scholarships');
        Schema::dropIfExists('scholarships');
        Schema::dropIfExists('student_payments');
        Schema::dropIfExists('fee_structures');
        Schema::dropIfExists('fee_types');
    }
};
