<?php

use App\Http\Controllers\Api\SpecialForYou;
use App\Http\Controllers\Api\Users\EditProfileController;
use App\Http\Controllers\Api\Users\ForgotPasswordController;
use App\Http\Controllers\Api\Users\ResetPasswordController;
use App\Http\Controllers\Api\Users\SocialLoginController;
use App\Http\Controllers\Api\Users\UserController;
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
        Route::post('user/change_password', [EditProfileController::class, 'change_password'])->middleware('checkUser:user-api');
        // Route::post('user/wishlist', [WishlistController::class, 'wishlist'])->middleware('checkUser:user-api');
        // Route::post('user/getAllWishlist', [WishlistController::class, 'getAllWishlist'])->middleware('checkUser:user-api', 'checkLang');
        // Route::post('user/is_like/product', [WishlistController::class, 'Is_like'])->middleware('checkUser:user-api');

    });
});

Route::get('getSpecialForYou',[\App\Http\Controllers\Api\SpecialForYou::class,'getSpecialForYou']);




