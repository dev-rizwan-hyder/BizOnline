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
        Schema::create('project_user', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->primary(['project_id', 'user_id']);
        });

        // Migrate existing assigned_to data if any exists
        $projects = \Illuminate\Support\Facades\DB::table('projects')->whereNotNull('assigned_to')->get();
        foreach ($projects as $p) {
            \Illuminate\Support\Facades\DB::table('project_user')->insertOrIgnore([
                'project_id' => $p->id,
                'user_id' => $p->assigned_to,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
    }
};
