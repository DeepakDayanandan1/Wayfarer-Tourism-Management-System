<?php

use Illuminate\Support\Facades\Route;

// Public & Traveler Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\PageController;

// Auth Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Admin\IssueController as AdminIssueController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

/*
|--------------------------------------------------------------------------
| Public Traveler Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tour Packages
Route::get('/packages', [TourPackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{id}', [TourPackageController::class, 'show'])->name('packages.show');
Route::post('/packages/{id}/book', [BookingController::class, 'store'])->name('packages.book');
Route::post('/bookings/{id}', [BookingController::class, 'store'])->name('bookings.store');

// Booking Confirmation & History
Route::get('/thank-you', [BookingController::class, 'thankyou'])->name('bookings.thankyou');
Route::get('/tour-history', [BookingController::class, 'history'])->name('bookings.history');
Route::post('/tour-history/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

// Custom Trip Inquiry
Route::get('/enquiry', [EnquiryController::class, 'index'])->name('enquiry.index');
Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
Route::post('/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store');

// Support Tickets / Issues
Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

// Profile & Password
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/change-password', [ProfileController::class, 'changePasswordForm'])->name('profile.password');
Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// CMS Pages (About Us, Terms, Privacy, Contact)
Route::get('/page/{type}', [PageController::class, 'show'])->name('page.show');
Route::get('/pages/{type}', [PageController::class, 'show'])->name('pages.show');

/*
|--------------------------------------------------------------------------
| Traveler Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/logout.php', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::post('/check-email', [LoginController::class, 'checkEmail'])->name('check.email');

Route::get('/forgot-password', [PasswordController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [PasswordController::class, 'resetPassword'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Admin Portal Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Guest Routes
    Route::middleware('guest.admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
        Route::get('/forgot-password', [AdminAuthController::class, 'showForgotPassword'])->name('forgot.password');
        Route::post('/forgot-password', [AdminAuthController::class, 'forgotPassword'])->name('forgot.password.submit');
    });

    // Admin Authenticated Routes
    Route::middleware('admin')->group(function () {
        Route::match(['get', 'post'], '/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::match(['get', 'post'], '/logout.php', [AdminAuthController::class, 'logout']);
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/', [AdminDashboardController::class, 'index']);

        // Tour Packages CRUD
        Route::resource('packages', AdminPackageController::class)->except(['show']);
        Route::get('/packages/{id}/change-image', [AdminPackageController::class, 'changeImageForm'])->name('packages.change-image');
        Route::post('/packages/{id}/change-image', [AdminPackageController::class, 'updateImage'])->name('packages.update-image');

        // Manage Bookings
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/{id}/confirm', [AdminBookingController::class, 'confirm'])->name('bookings.confirm');
        Route::post('/bookings/{id}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');

        // Manage Users & History
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{email}/bookings', [AdminUserController::class, 'userBookings'])->name('users.bookings');

        // Manage Enquiries
        Route::get('/enquiries', [AdminEnquiryController::class, 'index'])->name('enquiries.index');
        Route::post('/enquiries/{id}/read', [AdminEnquiryController::class, 'markAsRead'])->name('enquiries.read');
        Route::delete('/enquiries/{id}', [AdminEnquiryController::class, 'destroy'])->name('enquiries.destroy');

        // Support Tickets
        Route::get('/issues', [AdminIssueController::class, 'index'])->name('issues.index');
        Route::get('/issues/{id}', [AdminIssueController::class, 'show'])->name('issues.show');
        Route::post('/issues/{id}/remark', [AdminIssueController::class, 'updateRemark'])->name('issues.remark');
        Route::delete('/issues/{id}', [AdminIssueController::class, 'destroy'])->name('issues.destroy');

        // CMS Pages Management
        Route::get('/pages', [AdminPageController::class, 'index'])->name('pages.index');
        Route::post('/pages', [AdminPageController::class, 'update'])->name('pages.update');

        // Admin Profile & Password
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::get('/change-password', [AdminProfileController::class, 'changePassword'])->name('profile.password');
        Route::post('/change-password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');
    });
});
