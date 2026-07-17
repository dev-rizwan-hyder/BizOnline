<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_employee()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $employee = User::factory()->create([
            'role' => 'employee',
            'contact_info' => '1234567890',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.employees.update', $employee), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'contact_info' => '0987654321',
        ]);

        $response->assertRedirect(route('admin.employees.index'));
        $this->assertDatabaseHas('users', [
            'id' => $employee->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'contact_info' => '0987654321',
        ]);
    }

    public function test_admin_can_view_employee_index_with_null_contact_info()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $employee = User::factory()->create([
            'role' => 'employee',
            'contact_info' => null,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.employees.index'));

        $response->assertStatus(200);
    }
}
