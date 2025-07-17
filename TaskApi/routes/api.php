<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
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
  


});

//employeess
Route::resource('employees', EmployeeController::class);
Route::post('save/employee/{id}', [EmployeeController::class, 'saveEmployee']);

//task
Route::resource('tasks', TaskController::class);
Route::post('save/task/{id}', [TaskController::class, 'saveTask']);
Route::get('pending/task/all', [TaskController::class, 'countAllPendingTask']);


//report
Route::get('reportSummary', [ReportController::class, 'reportCountSummary']);
Route::get('report/date-range/complete', [ReportController::class, 'getCompletedTask']);


//user
Route::resource('user', User::class);


//auth

Route::post('/register', [AuthController::class, 'register']);

