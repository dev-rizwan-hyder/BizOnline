<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

// Guest-only routes
Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

// Public Website Routes (accessible by guests and logged-in users)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

$showServicePage = function (string $service) {
    $aliases = [
        'logo-design' => 'logo-visual-identity',
        'brand-identity' => 'brand-guidelines',
        'business-cards' => 'marketing-collateral',
        'social-media-kit' => 'social-media-assets',
        'packaging-design' => 'packaging-print-design',
        'business-websites' => 'corporate-websites',
        'ecommerce-websites' => 'ecommerce-stores',
        'custom-web-apps' => 'custom-web-applications',
        'cms-development' => 'cms-development-services',
        'website-redesign' => 'website-revamps-optimization',
        'android-apps' => 'android-development',
        'ios-apps' => 'ios-development',
        'cross-platform-apps' => 'cross-platform-apps-dev',
        'app-ui-ux-design' => 'mobile-ui-ux-design',
        'app-maintenance' => 'app-support-maintenance',
        'erp-systems' => 'erp-solutions',
        'crm-systems' => 'crm-platforms',
        'inventory-hrm' => 'hr-inventory-management',
        'billing-invoicing' => 'billing-accounting-systems',
        'school-hospital-software' => 'industry-specific-software',
        'api-development' => 'rest-api-development',
        'cloud-hosting-setup' => 'cloud-deployment-services',
        'database-design' => 'database-architecture',
        'server-deployment' => 'server-management',
        'devops-automation' => 'devops-cicd',
        'ai-chatbot-integration' => 'ai-chatbots',
        'automation-systems' => 'business-process-automation',
        'saas-product-development' => 'saas-development',
        'api-integrations' => 'ai-integrations',
        'data-analytics-dashboards' => 'analytics-business-intelligence',
        'seo' => 'search-engine-optimization',
        'google-ads-ppc' => 'paid-advertising-google-meta',
        'social-media-marketing' => 'social-media-marketing-growth',
        'content-marketing' => 'content-strategy',
        'email-campaigns' => 'email-marketing-automation',
    ];

    if (isset($aliases[$service])) {
        $service = $aliases[$service];
    }

    $pages = config('service_pages.pages');
    abort_unless(array_key_exists($service, $pages), 404);

    $page = $pages[$service];

    // Load database overrides if exist
    $dbService = \App\Models\Service::where('slug', $service)->first();
    if ($dbService) {
        if ($dbService->image) {
            $page['image'] = 'services/' . $page['category'] . '/' . $dbService->image;
        }
        if ($dbService->title) {
            $page['title'] = $dbService->title;
        }
        if ($dbService->headline) {
            $page['headline'] = $dbService->headline;
        }
        if ($dbService->intro) {
            $page['intro'] = $dbService->intro;
        }
        if ($dbService->packages) {
            $page['packages'] = $dbService->packages;
        }
        if ($dbService->work) {
            $page['work'] = $dbService->work;
        }
        if ($dbService->meta && is_array($dbService->meta)) {
            foreach ($dbService->meta as $mKey => $mVal) {
                if ($mVal !== null && $mVal !== '') {
                    $page[$mKey] = $mVal;
                }
            }
        }
    }

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
Route::get('/logo-design', fn () => $showServicePage('logo-visual-identity'))->name('logo.design');
Route::get('/brand-identity', fn () => $showServicePage('brand-guidelines'))->name('brand.identity');
Route::get('/services/{service}', $showServicePage)->name('services.show');

// Public Blog Routes
Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'show'])->name('blogs.show');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
        Route::resource('employees', \App\Http\Controllers\Admin\EmployeeController::class);
        Route::resource('tasks', \App\Http\Controllers\Admin\TaskController::class);
        Route::post('tasks/{task}/comments', [\App\Http\Controllers\Admin\TaskController::class, 'storeComment'])->name('tasks.comments.store');
        Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
        Route::resource('policies', \App\Http\Controllers\Admin\PolicyController::class);
        Route::get('attendances/sheet', [\App\Http\Controllers\Admin\AttendanceController::class, 'sheet'])->name('attendances.sheet');
        Route::resource('attendances', \App\Http\Controllers\Admin\AttendanceController::class);
        Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->only(['index', 'edit', 'update']);
    });

    Route::middleware(['role:employee'])->prefix('employee')->name('employee.')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('dashboard');
        Route::get('tasks', [\App\Http\Controllers\Employee\TaskController::class, 'index'])->name('tasks.index');
        Route::get('tasks/{task}', [\App\Http\Controllers\Employee\TaskController::class, 'show'])->name('tasks.show');
        Route::patch('tasks/{task}/status', [\App\Http\Controllers\Employee\TaskController::class, 'updateStatus'])->name('tasks.status');
        Route::post('tasks/{task}/start', [\App\Http\Controllers\Employee\TaskController::class, 'start'])->name('tasks.start');
        Route::post('tasks/{task}/pause', [\App\Http\Controllers\Employee\TaskController::class, 'pause'])->name('tasks.pause');
        Route::post('tasks/{task}/resume', [\App\Http\Controllers\Employee\TaskController::class, 'resume'])->name('tasks.resume');
        Route::post('tasks/{task}/finish', [\App\Http\Controllers\Employee\TaskController::class, 'finish'])->name('tasks.finish');
        Route::post('tasks/{task}/comments', [\App\Http\Controllers\Employee\TaskController::class, 'storeComment'])->name('tasks.comments.store');
        
        // Attendance Routes
        Route::get('attendance', [\App\Http\Controllers\Employee\AttendanceController::class, 'index'])->name('attendance');
        Route::post('attendance/check-in', [\App\Http\Controllers\Employee\AttendanceController::class, 'checkIn'])->name('attendance.check-in');
        Route::post('attendance/break-start', [\App\Http\Controllers\Employee\AttendanceController::class, 'startBreak'])->name('attendance.break-start');
        Route::post('attendance/break-end', [\App\Http\Controllers\Employee\AttendanceController::class, 'endBreak'])->name('attendance.break-end');
        Route::post('attendance/check-out', [\App\Http\Controllers\Employee\AttendanceController::class, 'checkOut'])->name('attendance.check-out');

        // Personal Report & Policy Routes
        Route::get('reports', [\App\Http\Controllers\Employee\ReportController::class, 'index'])->name('reports.index');
        Route::get('policies', [\App\Http\Controllers\Employee\PolicyController::class, 'index'])->name('policies.index');
    });
});
