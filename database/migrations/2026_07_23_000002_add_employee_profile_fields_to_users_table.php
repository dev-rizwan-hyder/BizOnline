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
        Schema::table('users', function (Blueprint $table) {
            $table->string('father_name')->nullable()->after('name');
            $table->date('date_of_birth')->nullable()->after('father_name');
            $table->string('cnic_number')->nullable()->after('date_of_birth');
            $table->string('mobile_number_1')->nullable()->after('cnic_number');
            $table->string('mobile_number_2')->nullable()->after('mobile_number_1');
            $table->text('current_address')->nullable()->after('mobile_number_2');
            $table->string('job_title')->nullable()->after('current_address');
            $table->string('department')->nullable()->after('job_title');
            $table->date('date_of_joining')->nullable()->after('department');
            $table->text('bank_account_details')->nullable()->after('date_of_joining');
            $table->string('emergency_contact')->nullable()->after('bank_account_details');
            $table->string('cv_resume_path')->nullable()->after('emergency_contact');
            $table->string('profile_photo_path')->nullable()->after('cv_resume_path');
            $table->string('experience_letters_path')->nullable()->after('profile_photo_path');
            $table->string('employment_status')->default('Active')->after('experience_letters_path'); // Active, Probation, Contract, Terminated, On Leave
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'father_name',
                'date_of_birth',
                'cnic_number',
                'mobile_number_1',
                'mobile_number_2',
                'current_address',
                'job_title',
                'department',
                'date_of_joining',
                'bank_account_details',
                'emergency_contact',
                'cv_resume_path',
                'profile_photo_path',
                'experience_letters_path',
                'employment_status',
            ]);
        });
    }
};
