<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;



Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    // Show the form
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

    // Handle form submission
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/', function () {
        return view('welcome');
    });

    $showServicePage = function (string $service) {
        $pages = config('service_pages.pages');
        abort_unless(array_key_exists($service, $pages), 404);

        $page = $pages[$service];
        $categories = config('service_pages.categories');
        abort_unless(isset($categories[$page['category']]), 404);

        $category = $categories[$page['category']];
        $page['image'] = $page['image'] ?? $category['image'];
        $page['work_images'] = $page['work_images'] ?? $category['work_images'];

        return view('services.show', [
            'page' => $page,
            'category' => $category,
            'slug' => $service,
        ]);
    };

    Route::view('/work', 'work')->name('work');
    Route::get('/logo-design', fn () => $showServicePage('logo-design'))->name('logo.design');
    Route::get('/brand-identity', fn () => $showServicePage('brand-identity'))->name('brand.identity');
    Route::get('/services/{service}', $showServicePage)->name('services.show');

});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('employees', \App\Http\Controllers\Admin\EmployeeController::class);
        Route::resource('tasks', \App\Http\Controllers\Admin\TaskController::class);
        Route::get('attendances/sheet', [\App\Http\Controllers\Admin\AttendanceController::class, 'sheet'])->name('attendances.sheet');
        Route::resource('attendances', \App\Http\Controllers\Admin\AttendanceController::class);
    });

    Route::middleware(['role:employee'])->prefix('employee')->name('employee.')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('dashboard');
        Route::get('tasks/{task}', [\App\Http\Controllers\Employee\TaskController::class, 'show'])->name('tasks.show');
        Route::patch('tasks/{task}/status', [\App\Http\Controllers\Employee\TaskController::class, 'updateStatus'])->name('tasks.status');
        
        // Attendance Routes
        Route::post('attendance/check-in', [\App\Http\Controllers\Employee\AttendanceController::class, 'checkIn'])->name('attendance.check-in');
        Route::post('attendance/break-start', [\App\Http\Controllers\Employee\AttendanceController::class, 'startBreak'])->name('attendance.break-start');
        Route::post('attendance/break-end', [\App\Http\Controllers\Employee\AttendanceController::class, 'endBreak'])->name('attendance.break-end');
        Route::post('attendance/check-out', [\App\Http\Controllers\Employee\AttendanceController::class, 'checkOut'])->name('attendance.check-out');
    });
});
