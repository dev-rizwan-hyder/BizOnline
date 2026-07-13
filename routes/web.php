<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;



Route::middleware(['guest'])->group(function () {
    Route::get('login', action: [AuthController::class, 'test'])->name('login');
    Route::post(uri: 'login', action: [AuthController::class, 'login'])->name('login');

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
    Route::get('test', [ContactController::class, 'test'])->name('test');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

});
