<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\metricsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JustificationController;

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

// dd(Carbon\Carbon::now());
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/privacyPolicy', function () {
    return view('privacy');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

// admin route


   


    Route::group(['middleware' => ['auth']],function(){
        Route::resource('/user', UsersController::class);
        Route::group(['middleware' => ['role:Piflow Admin']],function(){
        Route::post('/company/store', [CompanyController::class,'store'])->name('company.store');
        Route::get('/company/create', [CompanyController::class,'create'])->name('company.create');
        Route::get('/company/edit/{id}', [CompanyController::class,'edit'])->name('company.edit');
        Route::Put('/company/update/{id}', [CompanyController::class,'update'])->name('company.update');
        });

        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
        Route::get('/user-dates/{company_id}',[UsersController::class,'userDates'])->name('user.dates');
        Route::get('/CompanyAccounts/{company_id}',[UsersController::class,'getCompanyAccount'])->name('company.account');
        // Route::get('/categories/{user_id}/{date}',[UsersController::class,'getUserDateCategory'])->name('user.categories');
        Route::get('/financialcategories/{company_id}/{date}',[UsersController::class,'getCategories'])->name('user.categories');
        Route::get('/files',[UsersController::class,'getFiles'])->name('user.files');
        Route::get('/metrics/file/[{metrics_id},{file_id}]',[metricsController::class,'deleteFile'])->name('metrics.delete.file');
        Route::get('/files/file/{file_id}',[UsersController::class,'deleteFile'])->name('document.delete.file');

        Route::get('/info',[EmployeeController::class,'getAllEmployeeOfUser'])->name('info.all');
        Route::get('/metrics/create',[metricsController::class,'create'])->name('metrics.create');
        Route::post('/metrics/store',[metricsController::class,'store'])->name('metrics.store');
        Route::get('/metrics/file/[{metrics_id},{file_id}]',[metricsController::class,'deleteFile'])->name('metrics.delete.file');
        Route::post('/update-user-status',[UsersController::class, 'userActivation']);
        Route::post('/update-company-status',[UsersController::class, 'companyActivation']);
        Route::post('/send',[NotificationController::class, 'send'])->name('Notification.send');

    // justification
        Route::get('/justification/create',[JustificationController::class,'create'])->name('justification.create');
        Route::get('/justification/edit/{id}',[JustificationController::class,'edit'])->name('justification.edit');
        Route::put('/justification/update/{id}',[JustificationController::class,'update'])->name('justification.update');
        Route::post('/justification/store',[JustificationController::class,'store'])->name('justification.store');

        // Route::put('/updateUser/{id}','UsersController@update')->name('userupdate');

        
// for dashboard show notifications not used now

Route::get('/SendNotification', [NotificationController::class, 'create'])->name('Notification.create');
Route::post('/Send', [NotificationController::class, 'send'])->name('Notification.send');
Route::get('/Notifications', [NotificationController::class, 'getAllNotifications'])->name('Notification.all');
Route::get('/notifications', [NotificationController::class, 'index'])->name('Notification.index');
Route::get('/markAsRead',  [NotificationController::class, 'markAsRead'])->name('Notification.markAsRead');

 


   

    });
 

