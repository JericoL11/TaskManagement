<?php

use App\Http\Controllers\AuthProxyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::resource('employee', EmployeeController::class);
Route::resource('task', TaskController::class);
Route::resource('report', ReportController::class);


//specified functions

//employee
Route::get('getAllEmployers', [EmployeeController::class, 'getAllEmployers']);
Route::post('save/employee/{id}', [EmployeeController::class, 'saveEmployee']);
//  Route::get('getAllDepartments', [EmployeeController::class, 'getAllDepartments']); //lookup

//task
Route::get('getAllTask', [TaskController::class, 'getAllTask']);
Route::post('save/task/{id}', [TaskController::class, 'saveTask']);

//report
Route::get('getAllTaskSummary', [ReportController::class, 'getAllCountTaskSummary']);
Route::get('getTaskReport', [ReportController::class, 'getAllCompletedTask']);

//department
Route::resource('department', DepartmentController::class);
Route::get('getDepartments', [DepartmentController::class, 'getAllDepartments']);
Route::post('save/department/{id}', [DepartmentController::class, 'saveDepartment']);

//login
Route::get('/', [LoginController::class, 'signin']);
Route::get('signup-page', [LoginController::class, 'signup']);

//auth-public
Route::post('/auth/login', [AuthProxyController::class, 'login']);
Route::post('/auth/register', [AuthProxyController::class, 'register']);
Route::post('/auth/logout', [AuthProxyController::class, 'logout']);

//user
Route::get('getUserId', [UserController::class, 'getUserId']);


Route::post('forgot-password/email', [AuthProxyController::class, 'sendCode']);
Route::post('forgot-password/new-pass', [AuthProxyController::class, 'resetPassword']);