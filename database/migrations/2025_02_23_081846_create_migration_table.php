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
        // Academic Calendar and Sessions
        Schema::create('academic_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_current')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_session_id');
            $table->string('name', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_current')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
        });

        Schema::create('academic_calendar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_session_id');
            $table->string('event_name', 100);
            $table->string('event_type', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
        });

        // Classes and Lessons
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('lecturer_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->unsignedBigInteger('semester_id');
            $table->string('name', 100);
            $table->integer('max_capacity')->nullable();
            $table->string('syllabus_url', 200)->nullable();
            $table->boolean('is_online')->default(false);
            $table->string('online_meeting_url', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['course_id', 'academic_session_id', 'semester_id']);
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('lecturer_id')->references('id')->on('lecturers');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
            $table->foreign('semester_id')->references('id')->on('semesters');
        });

        Schema::create('class_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('student_id');
            $table->date('enrollment_date');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['class_id', 'student_id']);
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hostel_id')->nullable();
            $table->string('room_number', 20);
            $table->integer('capacity');
            $table->string('room_type', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['hostel_id', 'room_number']);
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('room_id')->references('id')->on('rooms');
        });

        // Assessments
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->dateTime('due_date');
            $table->decimal('max_score', 5, 2);
            $table->string('submission_type', 50)->nullable();
            $table->text('grading_rubric')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('lesson_id')->references('id')->on('lessons');
        });

        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->dateTime('exam_date');
            $table->integer('duration_minutes');
            $table->decimal('max_score', 5, 2);
            $table->string('exam_type', 50);
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('proctor_id')->nullable();
            $table->boolean('is_online')->default(false);
            $table->string('online_exam_url', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('proctor_id')->references('id')->on('staff');
        });

        Schema::create('student_assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_id');
            $table->unsignedBigInteger('student_id');
            $table->dateTime('submission_date');
            $table->decimal('score', 5, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['assignment_id', 'student_id']);
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('student_exam_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('student_id');
            $table->decimal('score', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['exam_id', 'student_id']);
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('student_id')->references('id')->on('students');
        });

        // Attendance
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id');
            $table->unsignedBigInteger('student_id');
            $table->string('status', 10);
            $table->dateTime('timestamp');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['lesson_id', 'student_id']);
            $table->foreign('lesson_id')->references('id')->on('lessons');
            $table->foreign('student_id')->references('id')->on('students');
        });

        // Research and Projects
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('funding_amount', 10, 2)->nullable();
            $table->string('funding_source', 100)->nullable();
            $table->string('status', 20);
            $table->string('ethics_approval_status', 50)->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('project_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('participant_type', 20);
            $table->unsignedBigInteger('participant_id');
            $table->string('role', 100)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('project_id')->references('id')->on('research_projects');
        });

        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('title', 200);
            $table->text('authors');
            $table->date('publication_date')->nullable();
            $table->string('journal_name', 200)->nullable();
            $table->string('doi', 100)->unique()->nullable();
            $table->integer('citation_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('project_id')->references('id')->on('research_projects');
        });

        // Academic Records
        Schema::create('transcripts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->unsignedBigInteger('semester_id');
            $table->decimal('gpa', 3, 2);
            $table->decimal('cumulative_gpa', 3, 2);
            $table->integer('total_credit_hours');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['student_id', 'academic_session_id', 'semester_id']);
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
            $table->foreign('semester_id')->references('id')->on('semesters');
        });

        Schema::create('course_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transcript_id');
            $table->unsignedBigInteger('course_id');
            $table->string('grade', 2);
            $table->decimal('grade_point', 3, 2);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['transcript_id', 'course_id']);
            $table->foreign('transcript_id')->references('id')->on('transcripts');
            $table->foreign('course_id')->references('id')->on('courses');
        });

        // Library
        Schema::create('library_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('author', 100)->nullable();
            $table->string('isbn', 20)->unique()->nullable();
            $table->integer('publication_year')->nullable();
            $table->string('resource_type', 50);
            $table->integer('available_copies')->default(0);
            $table->integer('total_copies');
            $table->string('location', 50)->nullable();
            $table->string('dewey_decimal', 20)->nullable();
            $table->text('keywords')->nullable();
            $table->string('call_number', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('library_borrowings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_id');
            $table->unsignedBigInteger('student_id');
            $table->date('borrow_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('resource_id')->references('id')->on('library_resources');
            $table->foreign('student_id')->references('id')->on('students');
        });

        // Accommodation
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->integer('capacity');
            $table->string('gender', 10)->nullable();
            $table->unsignedBigInteger('warden_id')->nullable();
            $table->text('amenities')->nullable();
            $table->decimal('monthly_fee', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('warden_id')->references('id')->on('staff');
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->foreign('hostel_id')->references('id')->on('hostels');
        });

        Schema::create('room_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->date('assignment_date');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['room_id', 'student_id', 'academic_session_id']);
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_assignments');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('hostels');
        Schema::dropIfExists('library_borrowings');
        Schema::dropIfExists('library_resources');
        Schema::dropIfExists('course_grades');
        Schema::dropIfExists('transcripts');
        Schema::dropIfExists('publications');
        Schema::dropIfExists('project_participants');
        Schema::dropIfExists('research_projects');
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('student_exam_results');
        Schema::dropIfExists('student_assignment_submissions');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('class_enrollments');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('academic_calendar');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('academic_sessions');
    }
};
