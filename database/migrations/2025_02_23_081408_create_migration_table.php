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
        // Core Academic Structure
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('dean_id')->nullable();
            $table->date('established_date')->nullable();
            $table->string('website', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('faculty_id');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('head_id')->nullable();
            $table->date('established_date')->nullable();
            $table->text('research_focus')->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name', 'faculty_id']);
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('department_id');
            $table->string('degree_type', 50);
            $table->text('description')->nullable();
            $table->integer('duration_years');
            $table->unsignedBigInteger('coordinator_id')->nullable();
            $table->string('accreditation_status', 50)->nullable();
            $table->date('last_review_date')->nullable();
            $table->date('next_review_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name', 'department_id']);
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->integer('credit_hours');
            $table->unsignedBigInteger('department_id');
            $table->text('syllabus')->nullable();
            $table->text('learning_outcomes')->nullable();
            $table->boolean('is_elective')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::create('course_prerequisites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('prerequisite_id');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['course_id', 'prerequisite_id']);
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('prerequisite_id')->references('id')->on('courses');
        });

        Schema::create('program_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('course_id');
            $table->boolean('is_required')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['program_id', 'course_id']);
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('course_id')->references('id')->on('courses');
        });

        // People
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 10)->nullable();
            $table->date('hire_date');
            $table->string('employee_id', 20)->unique();
            $table->string('highest_degree', 50)->nullable();
            $table->text('specialization')->nullable();
            $table->text('research_interests')->nullable();
            $table->string('office_location', 100)->nullable();
            $table->text('office_hours')->nullable();
            $table->integer('publications_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lecturer_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lecturer_id');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['lecturer_id', 'department_id']);
            $table->foreign('lecturer_id')->references('id')->on('lecturers');
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();
            $table->date('date_of_birth');
            $table->string('gender', 10)->nullable();
            $table->string('student_id', 20)->unique();
            $table->integer('enrollment_year');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('current_grade_id');
            $table->unsignedBigInteger('advisor_id')->nullable();
            $table->string('nationality', 50)->nullable();
            $table->string('admission_type', 50)->nullable();
            $table->decimal('admission_score', 5, 2)->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_phone', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('current_grade_id')->references('id')->on('grades');
            $table->foreign('advisor_id')->references('id')->on('lecturers');
        });

        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique()->nullable();
            $table->string('phone', 20);
            $table->string('relationship', 50);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('parent_id');
            $table->boolean('is_emergency_contact')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['student_id', 'parent_id']);
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('parent_id')->references('id')->on('parents');
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 10)->nullable();
            $table->date('hire_date');
            $table->string('employee_id', 20)->unique();
            $table->unsignedBigInteger('department_id');
            $table->string('role', 100);
            $table->boolean('is_active')->default(true);
            $table->string('highest_education', 100)->nullable();
            $table->text('specialization')->nullable();
            $table->string('contract_type', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('department_id')->references('id')->on('departments');
        });

        // Update foreign key constraints
        Schema::table('faculties', function (Blueprint $table) {
            $table->foreign('dean_id')->references('id')->on('lecturers');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('head_id')->references('id')->on('lecturers');
        });

        Schema::table('programs', function (Blueprint $table) {
            $table->foreign('coordinator_id')->references('id')->on('lecturers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_parents');
        Schema::dropIfExists('parents');
        Schema::dropIfExists('students');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('lecturer_departments');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('lecturers');
        Schema::dropIfExists('program_courses');
        Schema::dropIfExists('course_prerequisites');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('faculties');
    }
};
