<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    CategoryController,
    UserInfoController,
    UserController,
    PageController,
    SitemapController,
    ContactUsController,
    Apartment\CartController,
    Apartment\TermsController,
    Apartment\BookingController,
    Apartment\PaymentController,
    Property\ApartmentController,
    Apartment\PetPolicyController,
    Apartment\TestimonialController,
    Apartment\PropertyImageController,
    Property\Apartment\FeesController,
    Apartment\ApartmentTermsController,
    Apartment\ApartmentRatingController,
    Apartment\ApartmentReviewController,
    Apartment\ApartmentPetPolicyController,
    Property\Apartment\AmenitiesController,
    Property\Apartment\LeasePeriodController,
    Property\Apartment\ApartmentLeasePeriodController,
};
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



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('category', CategoryController::class);
Route::resource('apartment', ApartmentController::class);
Route::resource('apartment-rating', ApartmentRatingController::class);
Route::resource('testimonial', TestimonialController::class);
Route::resource('apartment-review', ApartmentReviewController::class);
Route::resource('amenities', AmenitiesController::class);
Route::resource('property-image', PropertyImageController::class);
Route::resource('pet-policy', PetPolicyController::class);
Route::resource('apartment-pet-policy', ApartmentPetPolicyController::class);
Route::resource('fees', FeesController::class);
Route::resource('lease-period', LeasePeriodController::class);
Route::resource('apartment-lease-period', ApartmentLeasePeriodController::class);
Route::resource('terms', TermsController::class);
Route::resource('apartment-terms', ApartmentTermsController::class);
Route::resource('booking', BookingController::class);
Route::resource('payment', PaymentController::class);
Route::resource('user-info', UserInfoController::class);
Route::resource('contact-us', ContactUsController::class);
Route::resource('cart', CartController::class);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('sitemap', [SitemapController::class, 'index']);
Route::get('/', [PageController::class, 'index'])->name('landing_page');