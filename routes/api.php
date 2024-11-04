<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\serviceController;
use App\Http\Controllers\Api\SpecialForYou;
use App\Http\Controllers\Api\SpecialistController;
use App\Http\Controllers\Api\Users\EditProfileController;
use App\Http\Controllers\Api\Users\FeedbackController;
use App\Http\Controllers\Api\Users\ForgotPasswordController;
use App\Http\Controllers\Api\Users\ResetPasswordController;
use App\Http\Controllers\Api\Users\SocialLoginController;
use App\Http\Controllers\Api\Users\UserController;
use App\Http\Controllers\Api\Users\WishlistController;
use App\Http\Controllers\Api\Users\WishlistForSpecialistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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
        Route::get('user_notifications', [NotificationsController::class,'userNotifications'])->name('userNotifications');
        Route::get('read_notifications', [NotificationsController::class,'read_notifications'])->name('read_notifications');
        Route::post('user/change_password', [EditProfileController::class, 'change_password'])->middleware('checkUser:user-api');
        // Route::post('user/wishlist', [WishlistController::class, 'wishlist'])->middleware('checkUser:user-api');
        // Route::post('user/getAllWishlist', [WishlistController::class, 'getAllWishlist'])->middleware('checkUser:user-api', 'checkLang');
             // Route::post('user/is_like/product', [WishlistController::class, 'Is_like'])->middleware('checkUser:user-api');
               Route::get('getUpcomingBookings',[\App\Http\Controllers\Api\BookingsController::class,'getUpcomingBookings']);

               Route::post('add/service/to/wishlist', [WishlistController::class, 'wishlist']);
               Route::post('add/specialist/to/wishlist', [WishlistForSpecialistController::class, 'specialist_wishlist']);

               Route::post('turn/notify', [HomeController::class, 'turn_notify']);
        Route::get('services', [serviceController::class, 'getAllServices'])->name('services');
        Route::get('getAllSpecialists', [\App\Http\Controllers\Api\SpecialistController::class, 'getAllSpecialists']);
        Route::post('user/add/feedback', [FeedbackController::class, 'add_feedback']);
        Route::get('getfeedbacks', [FeedbackController::class, 'get_all_feedbacks']);




    });

    //El_Mohamady
    
    Route::get('specialist/{id}', [SpecialistController::class,'getSpecialistDataById'])->name('getSpecialistDataById');
    Route::get('category_services/{catId}', [serviceController::class,'getAllServicesByCatId'])->name('getAllServicesByCatId');
    Route::post('search/services', [SearchController::class,'servicesSearch'])->name('servicesSearch');
});

Route::get('getSpecialForYou',[\App\Http\Controllers\Api\SpecialForYou::class,'getSpecialForYou']);
Route::get('getAllCategories',[\App\Http\Controllers\Api\CategoryController::class,'getAllCategories']);

Route::post('categorySpecialistSearch',[\App\Http\Controllers\Api\SearchController::class,'categorySpecialistSearch']);
Route::post('specialistSearch',[\App\Http\Controllers\Api\SearchController::class,'specialistSearch']);

Route::get('home',[\App\Http\Controllers\Api\HomeController::class,'Home']);

