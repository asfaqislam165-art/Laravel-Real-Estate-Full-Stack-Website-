<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController, 
    AdminController, 
    PropertyController, 
    CategoryController, 
    InquiryController, 
    SettingController, 
    ProfileController,
    ReviewController
};


Route::get('/services', [UserController::class, 'services'])->name('services');
/* Public Routes */
Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/properties', [UserController::class, 'properties'])->name('properties');
Route::get('/property/{id}', [UserController::class, 'propertyDetail'])->name('property.detail');
Route::post('/inquiry/store', [UserController::class, 'storeInquiry'])->name('inquiry.store');
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');

/* Customer Dashboard */
Route::get('/dashboard', function() {
    $inquiries = \App\Models\Inquiry::where('email', auth()->user()->email)->latest()->get();
    
    // 'name' er bodole sothik 'client_name' column use kora
    $reviews = \App\Models\Review::where('client_name', auth()->user()->name)
                ->latest()
                ->get();

    return view('dashboard', compact('inquiries', 'reviews'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Restricted Admin Panel Group */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Property Management
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/add', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties/add', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/edit/{id}', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::post('/properties/edit/{id}', [PropertyController::class, 'update'])->name('properties.update');
    Route::get('/properties/delete/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/property-image/delete/{id}', [PropertyController::class, 'destroyImage'])->name('property.image.destroy');

    // Category Management
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Customer Inquiries
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::post('/inquiries/status/{id}', [InquiryController::class, 'updateStatus'])->name('inquiries.status');
    Route::get('/inquiries/delete/{id}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

    // Review Management
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/toggle/{id}', [ReviewController::class, 'toggleStatus'])->name('reviews.toggle');
    Route::get('/reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Website Settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings/{id}', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';