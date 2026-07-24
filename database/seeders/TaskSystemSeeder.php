<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\HrDocument;
use App\Models\HrPolicy;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TaskSystemSeeder extends Seeder
{
    public function run(): void
    {
        // Single Admin Account (No fallback)
        $admin = User::firstOrCreate(
            ['email' => 'admin@biztech.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'contact_info' => '+92 300 1234567',
                'job_title' => 'System Administrator',
                'department' => 'Management',
            ]
        );

        // Employee / User Accounts (Role: user)
        $employeesData = [
            [
                'name' => 'Abid',
                'email' => 'abid@biztech.com',
                'father_name' => 'Muhammad Rafiq',
                'date_of_birth' => '1995-04-12',
                'cnic_number' => '35201-1234567-1',
                'mobile_number_1' => '+92 301 1111111',
                'mobile_number_2' => '+92 321 1111112',
                'current_address' => 'House #12, Block B, Johar Town, Lahore',
                'job_title' => 'Senior Frontend Developer',
                'department' => 'Software Engineering',
                'date_of_joining' => '2023-01-15',
                'bank_account_details' => 'Meezan Bank - Account #: 01020304050607 - IBAN: PK36MEZN0001020304050607',
                'emergency_contact' => 'Muhammad Rafiq (Father) - +92 300 9999991',
                'employment_status' => 'Active',
                'assigned' => 12, 'completed' => 8, 'pending' => 3, 'delayed' => 1
            ],
            [
                'name' => 'Rizwan',
                'email' => 'rizwan@biztech.com',
                'father_name' => 'Hyder Ali',
                'date_of_birth' => '1993-08-22',
                'cnic_number' => '35201-7654321-3',
                'mobile_number_1' => '+92 302 2222222',
                'mobile_number_2' => '+92 333 2222223',
                'current_address' => 'Flat 402, Al-Hafeez Heights, Gulberg III, Lahore',
                'job_title' => 'Full Stack Laravel Lead',
                'department' => 'Web Development',
                'date_of_joining' => '2022-06-01',
                'bank_account_details' => 'Habib Bank Limited - Account #: 998877665544 - IBAN: PK98HABB00998877665544',
                'emergency_contact' => 'Brother - +92 300 9999992',
                'employment_status' => 'Active',
                'assigned' => 30, 'completed' => 27, 'pending' => 3, 'delayed' => 0
            ],
            [
                'name' => 'Junaid',
                'email' => 'junaid@biztech.com',
                'father_name' => 'Tariq Mehmood',
                'date_of_birth' => '1996-11-05',
                'cnic_number' => '35201-9876543-5',
                'mobile_number_1' => '+92 303 3333333',
                'mobile_number_2' => '+92 312 3333334',
                'current_address' => 'Street 5, Cavalry Ground, Lahore Cantt',
                'job_title' => 'UI/UX & Brand Designer',
                'department' => 'Creative & Design',
                'date_of_joining' => '2023-09-10',
                'bank_account_details' => 'Bank Alfalah - Account #: 4455667788 - IBAN: PK12ALFH004455667788',
                'emergency_contact' => 'Uncle - +92 300 9999993',
                'employment_status' => 'Probation',
                'assigned' => 40, 'completed' => 39, 'pending' => 1, 'delayed' => 0
            ],
            [
                'name' => 'Helper',
                'email' => 'helper@biztech.com',
                'father_name' => 'Aslam Pervez',
                'date_of_birth' => '1998-02-18',
                'cnic_number' => '35201-5554443-7',
                'mobile_number_1' => '+92 304 4444444',
                'mobile_number_2' => null,
                'current_address' => 'Model Town Extension, Lahore',
                'job_title' => 'Junior Support Specialist',
                'department' => 'Operations & Support',
                'date_of_joining' => '2024-02-01',
                'bank_account_details' => 'EasyPaisa Account: 03044444444',
                'emergency_contact' => 'Father - +92 300 9999994',
                'employment_status' => 'Contract',
                'assigned' => 15, 'completed' => 15, 'pending' => 0, 'delayed' => 0
            ],
        ];

        foreach ($employeesData as $empInfo) {
            $user = User::updateOrCreate(
                ['email' => $empInfo['email']],
                [
                    'name' => $empInfo['name'],
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'contact_info' => $empInfo['mobile_number_1'],
                    'father_name' => $empInfo['father_name'],
                    'date_of_birth' => $empInfo['date_of_birth'],
                    'cnic_number' => $empInfo['cnic_number'],
                    'mobile_number_1' => $empInfo['mobile_number_1'],
                    'mobile_number_2' => $empInfo['mobile_number_2'],
                    'current_address' => $empInfo['current_address'],
                    'job_title' => $empInfo['job_title'],
                    'department' => $empInfo['department'],
                    'date_of_joining' => $empInfo['date_of_joining'],
                    'bank_account_details' => $empInfo['bank_account_details'],
                    'emergency_contact' => $empInfo['emergency_contact'],
                    'employment_status' => $empInfo['employment_status'],
                ]
            );

            // Generate exact number of tasks for this user matching prompt metrics
            $taskCounter = 1;

            // Create Completed tasks
            for ($i = 0; $i < $empInfo['completed']; $i++) {
                Task::create([
                    'title' => "{$empInfo['name']}'s Task #{$taskCounter} - Completed Work",
                    'description' => "Execution and completion of assigned module feature #{$taskCounter}.",
                    'due_date' => Carbon::today(),
                    'deadline' => Carbon::today()->setTime(17, 0),
                    'priority' => ($i % 3 == 0) ? 'high' : (($i % 2 == 0) ? 'medium' : 'low'),
                    'status' => 'completed',
                    'is_recurring' => ($i % 4 == 0),
                    'recurring_frequency' => ($i % 4 == 0) ? 'daily' : null,
                    'assigned_to' => $user->id,
                    'assigned_by' => $admin->id,
                ]);
                $taskCounter++;
            }

            // Create Pending / In Progress tasks
            for ($i = 0; $i < $empInfo['pending']; $i++) {
                Task::create([
                    'title' => "{$empInfo['name']}'s Task #{$taskCounter} - In Progress",
                    'description' => "Ongoing task assignment requiring review and updates.",
                    'due_date' => Carbon::today(),
                    'deadline' => Carbon::today()->setTime(18, 30),
                    'priority' => ($i % 2 == 0) ? 'high' : 'medium',
                    'status' => ($i % 2 == 0) ? 'in_progress' : 'pending',
                    'is_recurring' => false,
                    'assigned_to' => $user->id,
                    'assigned_by' => $admin->id,
                ]);
                $taskCounter++;
            }

            // Create Delayed tasks
            for ($i = 0; $i < $empInfo['delayed']; $i++) {
                Task::create([
                    'title' => "{$empInfo['name']}'s Task #{$taskCounter} - Delayed Item",
                    'description' => "Task delayed due to external dependency or missing requirements.",
                    'due_date' => Carbon::today()->subDay(),
                    'deadline' => Carbon::today()->subDay()->setTime(16, 0),
                    'priority' => 'high',
                    'status' => 'delayed',
                    'delay_reason' => 'Waiting for client approval and API key details.',
                    'is_recurring' => false,
                    'assigned_to' => $user->id,
                    'assigned_by' => $admin->id,
                ]);
                $taskCounter++;
            }
        }

        // Seed HR Documents & Policies
        HrDocument::create([
            'title' => 'BizTech Employee Handbook 2026',
            'category' => 'company',
            'description' => 'Official employee rules, office timings, and code of conduct.',
            'uploaded_by' => $admin->id,
        ]);

        HrDocument::create([
            'title' => 'Standard Employment Terms & IT Policy',
            'category' => 'policy',
            'description' => 'Security protocols, workstation guidelines, and remote access rules.',
            'uploaded_by' => $admin->id,
        ]);

        HrPolicy::create([
            'title' => 'Daily Task & Performance Standards',
            'category' => 'Performance & Review',
            'effective_date' => Carbon::today()->startOfYear(),
            'summary' => 'Rules governing task logging, daily deadlines, and status updates.',
            'content' => 'All employees must update their task statuses daily before 6:00 PM. Delayed tasks require explicit delay explanations.',
            'is_active' => true,
        ]);

        HrPolicy::create([
            'title' => 'Break and Attendance Policy',
            'category' => 'Attendance',
            'effective_date' => Carbon::today()->startOfYear(),
            'summary' => 'Check-in, Check-out, and Tea/Lunch break tracking guidelines.',
            'content' => 'Employees must log check-in timestamps upon arrival and track break start/end times in the system.',
            'is_active' => true,
        ]);

        HrPolicy::create([
            'title' => 'Annual Leave & Time Off Policy',
            'category' => 'Leave & Time Off',
            'effective_date' => Carbon::today()->startOfYear(),
            'summary' => 'Guidelines for paid annual leave, sick leaves, and casual leave applications.',
            'content' => 'Employees are entitled to 14 days of paid casual leave and 10 days of sick leave annually. Leave requests must be submitted at least 3 days in advance.',
            'is_active' => true,
        ]);

        HrPolicy::create([
            'title' => 'Workstation & IT Security Policy',
            'category' => 'IT & Security',
            'effective_date' => Carbon::today()->startOfYear(),
            'summary' => 'Protocols for data safety, password hygiene, and remote device usage.',
            'content' => 'Employees must lock workstations when stepping away. System credentials and client data must never be shared across unencrypted channels.',
            'is_active' => true,
        ]);
    }
}
