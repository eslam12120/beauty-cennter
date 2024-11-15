<?php


use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FeedbackController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\SpecialistController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace'=>'Dashboard','middleware'=>'guest'],function(){
    Route::get('/',[LoginController::class,'login'])->name('admin.login');
    Route::post('/login',[LoginController::class,'check'])->name('admin.check');
});
Route::group(['namespace'=>'Dashboard','middleware'=>'auth:admin', 'prefix' => 'admin'],function(){
   
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
     Route::get('/export/pdf',  [DashboardController::class,'export_pdf'])->name('export_pdf');
    


//route categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoriesController::class,'index'])->name('category.index');
        Route::get('create', [CategoriesController::class,'create'])->name('category.create');
        Route::post('store', [CategoriesController::class,'store'])->name('category.store');
        Route::get('edit/{id}', [CategoriesController::class,'edit'])->name('category.edit');
        Route::post('update/{id}', [CategoriesController::class,'update'])->name('category.update');
        Route::get('delete/{id}', [CategoriesController::class,'destroy'])->name('category.delete');
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

});
Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy.policy');
Route::get('/account-deletion', function () {
    return view('deletion');
})->name('account-deletion');