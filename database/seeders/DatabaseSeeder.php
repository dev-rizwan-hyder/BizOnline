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
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@biztech.com',
            'password' => bcrypt('biztech123'),
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Employee',
            'email' => 'employee@biztech.com',
            'password' => bcrypt('employee123'),
            'role' => 'employee',
        ]);
    }
}
