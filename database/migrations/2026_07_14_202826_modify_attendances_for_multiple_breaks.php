<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First add the new column
        Schema::table('attendances', function (Blueprint $table) {
            $table->json('breaks')->nullable()->after('check_in');
        });

        // Migrate existing data
        $attendances = DB::table('attendances')->whereNotNull('break_start')->get();
        foreach ($attendances as $attendance) {
            $breakData = [
                [
                    'start' => $attendance->break_start,
                    'end' => $attendance->break_end,
                ]
            ];
            DB::table('attendances')
                ->where('id', $attendance->id)
                ->update(['breaks' => json_encode($breakData)]);
        }

        // Drop old columns
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['break_start', 'break_end']);
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->timestamp('break_start')->nullable()->after('breaks');
            $table->timestamp('break_end')->nullable()->after('break_start');
        });

        $attendances = DB::table('attendances')->whereNotNull('breaks')->get();
        foreach ($attendances as $attendance) {
            $breaks = json_decode($attendance->breaks, true);
            if (!empty($breaks)) {
                $firstBreak = $breaks[0];
                DB::table('attendances')
                    ->where('id', $attendance->id)
                    ->update([
                        'break_start' => $firstBreak['start'] ?? null,
                        'break_end' => $firstBreak['end'] ?? null,
                    ]);
            }
        }

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('breaks');
        });
    }
};
