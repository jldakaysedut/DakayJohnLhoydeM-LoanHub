<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\LoanTypeController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\RequirementSubmitController;
use App\Http\Controllers\LoanStatusController;

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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    // User routes
    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

    // Loan routes
    Route::get('/get-loans', [LoanController::class, 'getLoans']);
    Route::post('/add-loan', [LoanController::class, 'addLoan']);
    Route::put('/edit-loan/{id}', [LoanController::class, 'editLoan']);
    Route::delete('/delete-loan/{id}', [LoanController::class, 'deleteLoan']);

    // Role routes
    Route::get('/get-roles', [RoleController::class, 'getRoles']);
    Route::post('/add-role', [RoleController::class, 'addRole']);
    Route::put('/edit-role/{id}', [RoleController::class, 'editRole']); // Added edit route
    Route::delete('/delete-role/{id}', [RoleController::class, 'deleteRole']);

    // User Status routes
    Route::get('/get-user-statuses', [UserStatusController::class, 'getUserStatuses']);
    Route::post('/add-user-status', [UserStatusController::class, 'addUserStatus']);
    Route::put('/edit-user-status/{id}', [UserStatusController::class, 'editUserStatus']); // Added edit route
    Route::delete('/delete-user-status/{id}', [UserStatusController::class, 'deleteUserStatus']);

    // Loan Type routes
    Route::get('/get-loan-types', [LoanTypeController::class, 'getLoanTypes']);
    Route::post('/add-loan-type', [LoanTypeController::class, 'addLoanType']);
    Route::put('/edit-loan-type/{id}', [LoanTypeController::class, 'editLoanType']); // Added edit route
    Route::delete('/delete-loan-type/{id}', [LoanTypeController::class, 'deleteLoanType']);

    // Requirement routes
    Route::get('/get-requirements', [RequirementController::class, 'getRequirements']);
    Route::post('/add-requirement', [RequirementController::class, 'addRequirement']);
    Route::put('/edit-requirement/{id}', [RequirementController::class, 'editRequirement']); // Added edit route
    Route::delete('/delete-requirement/{id}', [RequirementController::class, 'deleteRequirement']);

    // Requirement Submit routes
    Route::get('/get-requirement-submits', [RequirementSubmitController::class, 'getRequirementSubmits']);
    Route::post('/add-requirement-submit', [RequirementSubmitController::class, 'addRequirementSubmit']);
    Route::put('/edit-requirement-submit/{id}', [RequirementSubmitController::class, 'editRequirementSubmit']); // Added edit route
    Route::delete('/delete-requirement-submit/{id}', [RequirementSubmitController::class, 'deleteRequirementSubmit']);

    // Loan Status routes
    Route::get('/get-loan-statuses', [LoanStatusController::class, 'getLoanStatuses']);
    Route::post('/add-loan-status', [LoanStatusController::class, 'addLoanStatus']);
    Route::put('/edit-loan-status/{id}', [LoanStatusController::class, 'editLoanStatus']); // Added edit route
    Route::delete('/delete-loan-status/{id}', [LoanStatusController::class, 'deleteLoanStatus']);

    // Logout route
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});