<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\DetailDonateController; 
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Public Routes (Accessible to everyone)
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'welcome'])->name('home');

// Redirect authenticated users based on role
Route::get('/home', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard'); 
        } else {
            return redirect()->route('index'); 
        }
    }
    return redirect()->route('home'); 
});

Route::get('/nearme', [DetailDonateController::class, 'nearme'])->name('nearme');
Route::get('/meal', [DetailDonateController::class, 'meal'])->name('meal');
Route::post('/request-food', [DetailDonateController::class, 'requestFood'])->name('request.food');
Route::get('/browse', [DetailDonateController::class, 'publicIndex'])->name('browse');

Route::get('/donate', function () {
    return view('user.donate');
})->name('donate');

Route::post('/donate', [DetailDonateController::class, 'handleDonateStep1'])->name('donate1');
Route::get('/donate2', [DetailDonateController::class, 'showDonateStep2'])->name('donate2');
Route::post('/donate/submit', [DetailDonateController::class, 'sendDonationEmail'])->name('donate.final');

// Public FAQ page
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::post('/faq/question', [FaqController::class, 'submitQuestion'])->name('faq.question');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/review', [ReviewController::class, 'index'])->name('review');
Route::post('/review/submit', [ReviewController::class, 'submit'])->name('review.submit');


/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Registration routes
    Route::get('/sign', [RegisterController::class, 'showRegistrationStep1'])->name('sign');
    Route::post('/sign', [RegisterController::class, 'handleRegistrationStep1'])->name('sign.post');
    Route::get('/sign2', [RegisterController::class, 'showRegistrationStep2'])->name('sign2');
    Route::post('/sign2', [RegisterController::class, 'completeRegistration'])->name('sign2.post');
    Route::get('/register/clear', [RegisterController::class, 'clearRegistrationData'])->name('register.clear');
});

/*
|--------------------------------------------------------------------------
| User Protected Routes (Authenticated users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Main user dashboard/index page after login
    Route::get('/index', [DashboardController::class, 'index'])->name('index');
    Route::get('/user-dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User profile and settings
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::put('/settings/password', [DashboardController::class, 'updatePassword'])->name('settings.password');

    // Logout route - accessible to all authenticated users
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Admin users only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index']); // Alternative route without name
    
    // User management - FIXED ROUTES
    Route::get('/users/{user}', [AdminDashboardController::class, 'showUser'])->name('users.show');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('users.delete');
    
    // AJAX routes for dynamic content
    Route::get('/statistics', [AdminDashboardController::class, 'getStatistics'])->name('statistics');
    Route::get('/search-users', [AdminDashboardController::class, 'searchUsers'])->name('search-users');
    
    // Admin Review Routes - matching controller expectations
    Route::get('/reviews', [ReviewController::class, 'adminIndex'])->name('reviewA');
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviewA.store');
    Route::patch('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviewA.approve');
    Route::delete('/reviews/{review}/destroy', [ReviewController::class, 'destroy'])->name('reviewA.destroy');
    Route::get('/reviews/filter', [ReviewController::class, 'filter'])->name('reviewA.filter');
    
    // Logout route
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/login');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes with "A" suffix (Admin pages)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin donation management pages (3-step process)
    Route::get('/browseA', [DetailDonateController::class, 'adminIndex'])->name('browseA');
    
    Route::get('/browseA2', [DetailDonateController::class, 'createStep2'])->name('browseA2');
    Route::post('/browseA2', [DetailDonateController::class, 'storeStep2'])->name('browseA2.store');
    
    Route::get('/browseA3', [DetailDonateController::class, 'createStep3'])->name('browseA3');
    Route::post('/browseA3', [DetailDonateController::class, 'store'])->name('browseA3.store');
    
    // Donation management
    Route::patch('/donations/{donation}/status', [DetailDonateController::class, 'updateStatus'])->name('donations.updateStatus');
    Route::delete('/donations/{donation}', [DetailDonateController::class, 'destroy'])->name('donations.destroy');
    
    // Admin FAQ page with controller
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/faqA', [FaqController::class, 'adminIndex'])->name('faqA');
        Route::post('/faqA/store', [FaqController::class, 'store'])->name('faqA.store');
        Route::put('/faqA/{faq}', [FaqController::class, 'update'])->name('faqA.update');
        Route::delete('/faqA/{faq}', [FaqController::class, 'destroy'])->name('faqA.destroy');
        Route::patch('/faqA/{faq}/toggle', [FaqController::class, 'toggleActive'])->name('faqA.toggle');
        Route::post('/faqA/update-order', [FaqController::class, 'updateOrder'])->name('faqA.updateOrder');
    });
    
    // Admin dashboard page view (different from controller)
    Route::get('/dashboard-page', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard.view');
});

/*
|--------------------------------------------------------------------------
| Public Review Routes (for users)
|--------------------------------------------------------------------------
*/
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/reviews', [ReviewController::class, 'index'])->name('review');
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('review.show');
Route::middleware('auth')->group(function () {
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('review.update');
});
