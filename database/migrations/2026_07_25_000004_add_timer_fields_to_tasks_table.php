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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dateTime('started_at')->nullable()->after('recurring_frequency');
            $table->dateTime('paused_at')->nullable()->after('started_at');
            $table->dateTime('completed_at')->nullable()->after('paused_at');
            $table->unsignedInteger('total_seconds')->default(0)->after('completed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['started_at', 'paused_at', 'completed_at', 'total_seconds']);
        });
    }
};
