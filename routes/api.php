<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BasicSalaryController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\LeaveTypeController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ShiftController;
use Illuminate\Support\Facades\Route;

// Auth
Route::name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/me', [AuthController::class, 'me'])->name('me');
    });
});

Route::middleware('auth:sanctum')->group(function () {

    // Companies
    Route::apiResource('/companies', CompanyController::class);

    // Roles
    Route::apiResource('/roles', RoleController::class);

    // Departments
    Route::apiResource('/departments', DepartmentController::class);

    // Designations
    Route::apiResource('/designations', DesignationController::class);

    // Shifts
    Route::apiResource('/shifts', ShiftController::class);

    // Basic Salaries
    Route::apiResource('/basic-salaries', BasicSalaryController::class);

    // Holidays
    Route::apiResource('/holidays', HolidayController::class);

    // Leave Types
    Route::apiResource('/leave-types', LeaveTypeController::class);

});
