<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\TimeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\FeedbackController;
use App\Http\Controllers\Dashboard\FirebaseController;
use App\Http\Controllers\Dashboard\ServicesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\QuestionsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\SpecialistController;
use App\Http\Controllers\Dashboard\SpecialForYouController;
use App\Http\Controllers\Dashboard\SpecialistScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/time-slots/{id}', [SpecialistScheduleController::class, 'create']);
Route::get('available-times', [SpecialistScheduleController::class, 'getAvailableTimes'])->name('schedule.times');

Route::get('available-days', [SpecialistScheduleController::class, 'getAvailabledays'])->name('schedule.days');
// Route::get('/get-specialists-by-service', [SpecialistScheduleController::class, 'getSpecialistsByService'])->name('getSpecialistsByService');

Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest'], function () {
    Route::get('/', [LoginController::class, 'login'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'check'])->name('admin.check');
});
Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function () {

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/export/pdf',  [DashboardController::class, 'export_pdf'])->name('export_pdf');



    //route categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('category.index');
        Route::get('create', [CategoriesController::class, 'create'])->name('category.create');
        Route::post('store', [CategoriesController::class, 'store'])->name('category.store');
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])->name('category.edit');
        Route::post('update/{id}', [CategoriesController::class, 'update'])->name('category.update');
        Route::get('delete/{id}', [CategoriesController::class, 'destroy'])->name('category.delete');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('update/{id}', [userController::class, 'update'])->name('admin.users.update');
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    });
    Route::group(['prefix' => 'feedback'], function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('feedback.index');
    });
    Route::group(['prefix' => 'specialists'], function () {
        Route::get('/', [SpecialistController::class, 'index'])->name('specialist.index');
        Route::get('create', [SpecialistController::class, 'create'])->name('specialist.create');
        Route::post('store', [SpecialistController::class, 'store'])->name('specialist.store');
        Route::get('edit/{id}', [SpecialistController::class, 'edit'])->name('specialist.edit');
        Route::post('update/{id}', [SpecialistController::class, 'update'])->name('specialist.update');
        Route::get('delete/{id}', [SpecialistController::class, 'destroy'])->name('specialist.delete');
    });
    Route::group(['prefix' => 'times'], function () {
        Route::get('/', [TimeController::class, 'index'])->name('time.index');

        Route::get('destroy/{day}', [TimeController::class, 'destroy'])->name('time.destroy');
        Route::put('/time-schedules/update', [TimeController::class, 'updateMultiple'])->name('time.updateMultiple');
    });
    Route::group(['prefix' => 'services'], function () {
        Route::get('/', [ServicesController::class, 'index'])->name('services.index');
        Route::get('create', [ServicesController::class, 'create'])->name('services.create');
        Route::post('store', [ServicesController::class, 'store'])->name('services.store');
        Route::get('edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');
        Route::post('update/{id}', [ServicesController::class, 'update'])->name('services.update');
        Route::get('destroy/{id}', [ServicesController::class, 'destroy'])->name('services.destroy');
    });
    Route::group(['prefix' => 'booking'], function () {
        Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
    });
    Route::group(['prefix' => 'questions'], function () {
        Route::get('/', [QuestionsController::class, 'index'])->name('question.index');
        Route::get('create', [QuestionsController::class, 'create'])->name('question.create');
        Route::post('store', [QuestionsController::class, 'store'])->name('question.store');
        Route::get('edit/{id}', [QuestionsController::class, 'edit'])->name('question.edit');
        Route::post('update/{id}', [QuestionsController::class, 'update'])->name('question.update');
        Route::get('delete/{id}', [QuestionsController::class, 'destroy'])->name('question.delete');
    });
    Route::group(['prefix' => 'contact_us'], function () {
        Route::get('/', [ContactController::class, 'index'])->name('contact.index');
        Route::get('create', [ContactController::class, 'create'])->name('contact.create');
        Route::post('store', [ContactController::class, 'store'])->name('contact.store');
        Route::get('edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
        Route::post('update/{id}', [ContactController::class, 'update'])->name('contact.update');
        Route::get('delete/{id}', [ContactController::class, 'destroy'])->name('contact.delete');
    });
    Route::group(['prefix' => 'specialist-schedule'], function () {
        Route::get('/', [SpecialistScheduleController::class, 'index'])->name('schedule.index'); // عرض قائمة الجداول
        Route::get('create', [SpecialistScheduleController::class, 'create'])->name('schedule.create'); // عرض نموذج إضافة جدول
        Route::post('store', [SpecialistScheduleController::class, 'store'])->name('schedule.store'); // حفظ جدول جديد
        Route::get('edit/{id}', [SpecialistScheduleController::class, 'edit'])->name('schedule.edit'); // عرض نموذج تعديل جدول
        Route::post('update/{id}', [SpecialistScheduleController::class, 'update'])->name('schedule.update'); // تحديث الجدول
        Route::get('delete/{id}', [SpecialistScheduleController::class, 'destroy'])->name('schedule.destroy'); // حذف الجدول
        // جلب الأوقات المتاحة (AJAX)
    });
    Route::prefix('admin/banners')->name('admin.banners.')->group(function () {
        Route::get('/', [SpecialForYouController::class, 'index'])->name('index'); // List all banners
        Route::get('/create', [SpecialForYouController::class, 'create'])->name('create'); // Show create form
        Route::post('/store', [SpecialForYouController::class, 'store'])->name('store'); // Handle store logic
        Route::get('/delete/{id}', [SpecialForYouController::class, 'delete'])->name('delete'); // Handle delete logic
    });
    Route::get('/notifications/create', [FirebaseController::class, 'create'])->name('notification.create');

    // Store Route (Handle form submission)
    Route::post('/notifications/store', [FirebaseController::class, 'store'])->name('notification.store');
});

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy.policy');
Route::get('/account-deletion', function () {
    return view('deletion');
})->name('account-deletion');
