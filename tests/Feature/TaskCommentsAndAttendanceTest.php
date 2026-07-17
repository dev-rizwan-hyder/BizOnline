<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Attendance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class TaskCommentsAndAttendanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_comment_on_assigned_task()
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'assigned_to' => $employee->id,
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $response = $this->actingAs($employee)->post(route('employee.tasks.comments.store', $task), [
            'content' => 'This is a test comment from employee',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('task_comments', [
            'task_id' => $task->id,
            'user_id' => $employee->id,
            'content' => 'This is a test comment from employee',
        ]);
    }

    public function test_employee_cannot_comment_on_unassigned_task()
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $otherEmployee = User::factory()->create(['role' => 'employee']);
        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'assigned_to' => $otherEmployee->id,
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $response = $this->actingAs($employee)->post(route('employee.tasks.comments.store', $task), [
            'content' => 'Should not be allowed',
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_comment_on_any_task()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'employee']);
        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'assigned_to' => $employee->id,
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.tasks.comments.store', $task), [
            'content' => 'Admin feedback on task',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('task_comments', [
            'task_id' => $task->id,
            'user_id' => $admin->id,
            'content' => 'Admin feedback on task',
        ]);
    }

    public function test_employee_can_view_monthly_attendance()
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $today = Carbon::today();
        
        Attendance::create([
            'user_id' => $employee->id,
            'date' => $today->toDateString(),
            'check_in' => $today->copy()->hour(9),
            'check_out' => $today->copy()->hour(18),
            'status' => 'checked_out',
        ]);

        $response = $this->actingAs($employee)->get(route('employee.attendance', [
            'month' => $today->format('Y-m'),
        ]));

        $response->assertStatus(200);
        $response->assertSee($today->format('M d, Y'));
    }
}
