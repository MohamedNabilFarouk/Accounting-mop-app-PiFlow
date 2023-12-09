<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\DocumentController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\PosController;
use App\Http\Controllers\api\JustificationController;
use App\Http\Controllers\api\NotificationController;

use App\Http\Controllers\api\ForgotPasswordController;
use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\PackagesController;
use App\Http\Controllers\api\CompanyController;

/*
|--------------------------------------------------------------------------
| API Routes
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', [AuthController::class ,'login']);
    Route::post('register', [AuthController::class ,'register']);
    Route::post('logout', [AuthController::class ,'logout']);
    Route::post('refresh', [AuthController::class ,'refresh']);
    Route::post('me', [AuthController::class ,'me']);
});
Route::group([
    'middleware' => 'auth:api',
], function ($router) {

    Route::middleware('apiCustomAuth')->group(function () {

Route::post('/documents', [DocumentController::class, 'store']);
Route::post('/getUserDate', [DocumentController::class, 'getUserDate']);
Route::post('/getUsercategory', [DocumentController::class, 'getUserDateCategory']);
Route::post('/getFiles', [DocumentController::class, 'getFiles']);
Route::post('/getMetrics', [DocumentController::class, 'getMetrics']);
Route::get('/getCategories', [DocumentController::class, 'getcategories']);
Route::post('/deleteFile', [DocumentController::class, 'deleteFile']);

// employee
Route::get('/getEmployees', [EmployeeController::class, 'getAllEmployeeOfUser']);
Route::post('/addEmployee', [EmployeeController::class, 'store']);
// company users
Route::get('/getAllUsers', [CompanyController::class, 'getAllCompanyUsers']);
Route::delete('/deleteUser', [CompanyController::class, 'DeleteCompanyUser']);
Route::post('/changeUserStatus', [CompanyController::class, 'userActivation']);
Route::post('/updateCompany', [CompanyController::class, 'updateCompanyInfo']);

// pos
Route::post("/addPos", [PosController::class,'store']); 
Route::get('/getPos', [PosController::class, 'getAllPosOfUser']);
// Justifications
// Route::get('/getJust/{date}', [JustificationController::class, 'getAllJustOfUser']);
Route::get('/getJust', [JustificationController::class, 'getAllJustOfUser']);
Route::post('/addJustification', [JustificationController::class, 'store']);
Route::post('/changePassword', [AuthController::class, 'changePassword']);

// notifications 
Route::get('/usernotifications',[NotificationController::class, 'getUserNotifications'])->name("notification.user.get");
// update profile

Route::post('/updateProfile',[ProfileController::class, 'Update'])->name("updateProfile");
// end profile



});
});
// packages
Route::get('/AllPackages',[PackagesController::class, 'getPackages']);
// end packages
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('reset-password', [ResetPasswordController::class, 'reset']);
Route::post('checkcode', [ResetPasswordController::class, 'checkCode']);
