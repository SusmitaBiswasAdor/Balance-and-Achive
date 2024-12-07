<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\OtpVerificationController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);

// Register routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister']);

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('/password/reset', [ForgetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/verify', [OtpVerificationController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/password/reset/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

//Task routes
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

//Subtask routes
Route::prefix('tasks/{task}/subtasks')->group(function () {
    Route::get('/', [SubtaskController::class, 'index'])->name('subtasks.index');
    Route::post('/', [SubtaskController::class, 'store'])->name('subtasks.store');
    Route::put('/{subtask}', [SubtaskController::class, 'update'])->name('subtasks.update');
    Route::delete('/{subtask}', [SubtaskController::class, 'destroy'])->name('subtasks.destroy');
    Route::get('/manage', [SubtaskController::class, 'manage'])->name('subtasks.manage');
});
