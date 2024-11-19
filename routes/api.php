<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpecialForYou;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\serviceController;
use App\Http\Controllers\Api\BookingsController;
use App\Http\Controllers\Api\SpecialistController;
use App\Http\Controllers\Api\Users\UserController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\Users\WishlistController;
use App\Http\Controllers\Api\Users\EditProfileController;
use App\Http\Controllers\Api\Users\SocialLoginController;
use App\Http\Controllers\Api\Users\ResetPasswordController;
use App\Http\Controllers\Api\Users\ForgotPasswordController;
use App\Http\Controllers\Api\Users\WishlistForSpecialistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Api', 'middleware' => 'checkLang'], function () {

    Route::group(['namespace' => 'Users'], function () {

        Route::post('user/register', [UserController::class, 'register']);
        Route::post('user/login', [UserController::class, 'login']);
        Route::post('user/check/code', [UserController::class, 'check_otp']);
        Route::get('user/getUserById/{id}', [UserController::class, 'getUserById']);
        Route::post('password/email',  [ForgotPasswordController::class, 'forget']);
        Route::post('password/reset', [ResetPasswordController::class, 'code']);
        Route::post('user/social/login', [SocialLoginController::class, 'social_login']);
    });

    Route::group(['middleware' => 'checkUser:user-api'], function () {

        Route::post('user/logout', [UserController::class, 'logout']);
        Route::get('user/getUserData', [UserController::class, 'getUserData']);
        Route::post('user/edit', [EditProfileController::class, 'Editprofile']);
        Route::get('user_notifications', [NotificationsController::class, 'userNotifications'])->name('userNotifications');
        Route::get('read_notifications', [NotificationsController::class, 'read_notifications'])->name('read_notifications');
        Route::post('user/change_password', [EditProfileController::class, 'change_password'])->middleware('checkUser:user-api');
        // Route::post('user/wishlist', [WishlistController::class, 'wishlist'])->middleware('checkUser:user-api');
        // Route::post('user/getAllWishlist', [WishlistController::class, 'getAllWishlist'])->middleware('checkUser:user-api', 'checkLang');
        // Route::post('user/is_like/product', [WishlistController::class, 'Is_like'])->middleware('checkUser:user-api');
        Route::get('getUpcomingBookings', [\App\Http\Controllers\Api\BookingsController::class, 'getUpcomingBookings']);

        Route::post('add/service/to/wishlist', [WishlistController::class, 'wishlist']);
        Route::post('add/specialist/to/wishlist', [WishlistForSpecialistController::class, 'specialist_wishlist']);

        Route::post('turn/notify', [HomeController::class, 'turn_notify']);

        //
        Route::get('available/time', [BookingsController::class, 'get_available_days_time']);

        Route::get('service/available/time', [BookingsController::class, 'get_available_services_days_time']);



        Route::get('specialist/available/time', [BookingsController::class, 'get_available_specialist_days_time']);

        Route::get('get/specialist/available/time', [BookingsController::class, 'get_available_specialist_days_time_by_id']);

        //

        Route::post('add/cart', [BookingsController::class, 'add_cart']);
        Route::get('get/cart', [BookingsController::class, 'get_cart']);
        Route::post('delete/cart', [BookingsController::class, 'delete_cart']);
        Route::post('remind/me', [BookingsController::class, 'remind_me']);
        Route::get('get/cart/id', [BookingsController::class, 'get_cart_by_id']);
        Route::post('add/booking', [BookingsController::class, 'add_booking']);
        Route::post('cancel/booking', [BookingsController::class, 'cancel_booking']);

        Route::get('get/all/bookings', [BookingsController::class, 'getBookings']);



        //

        //


        //

        Route::post('user/add/feedback', [FeedbackController::class, 'add_feedback']);
        Route::get('getfeedbacks', [FeedbackController::class, 'get_all_feedbacks']);
    });

    //El_Mohamady
    Route::get('services', [serviceController::class, 'getAllServices'])->name('services');
    Route::get('specialist/{id}', [SpecialistController::class, 'getSpecialistDataById'])->name('getSpecialistDataById');
    Route::get('category_services/{catId}', [serviceController::class, 'getAllServicesByCatId'])->name('getAllServicesByCatId');
    Route::post('search/services', [SearchController::class, 'servicesSearch'])->name('servicesSearch');
});

Route::get('getSpecialForYou', [\App\Http\Controllers\Api\SpecialForYou::class, 'getSpecialForYou']);
Route::get('getAllCategories', [\App\Http\Controllers\Api\CategoryController::class, 'getAllCategories']);
Route::get('getAllSpecialists', [\App\Http\Controllers\Api\SpecialistController::class, 'getAllSpecialists']);
Route::post('categorySpecialistSearch', [\App\Http\Controllers\Api\SearchController::class, 'categorySpecialistSearch']);
Route::post('specialistSearch', [\App\Http\Controllers\Api\SearchController::class, 'specialistSearch']);

Route::get('home', [\App\Http\Controllers\Api\HomeController::class, 'Home']);
