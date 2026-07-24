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
            $table->dateTime('deadline')->nullable()->after('due_date');
            $table->text('delay_reason')->nullable()->after('status');
            $table->boolean('is_recurring')->default(false)->after('delay_reason');
            $table->string('recurring_frequency')->nullable()->after('is_recurring'); // e.g. daily, weekly
            $table->foreignId('assigned_by')->nullable()->after('assigned_to')->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['assigned_by']);
            $table->dropColumn(['deadline', 'delay_reason', 'is_recurring', 'recurring_frequency', 'assigned_by']);
        });
    }
};
