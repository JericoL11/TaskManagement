<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
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

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    //employeess
    Route::post('save/employee/{id}', [EmployeeController::class, 'saveEmployee']);
    Route::resource('employees', EmployeeController::class);

    //auth
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/profile', [AuthController::class, 'profile']);

    //report
    Route::get('reportSummary', [ReportController::class, 'reportCountSummary']);
    Route::get('report/date-range/complete', [ReportController::class, 'getCompletedTask']);

    //task
    Route::resource('tasks', TaskController::class);
    Route::post('save/task/{id}', [TaskController::class, 'saveTask']);
    Route::get('pending/task/all', [TaskController::class, 'countAllPendingTask']);


    //departments
    Route::resource('departments', DepartmentController::class);
    Route::post('save/department/{id}', [DepartmentController::class, 'saveDepartment']);
});



Route::post('forgot-password', [PasswordController::class, 'sendCode']);
Route::post('reset-password', [PasswordController::class, 'reset']);

//auth
Route::post('auth/register', [AuthController::class, 'createUser']);
Route::post('auth/login', [AuthController::class, 'loginUser']);



