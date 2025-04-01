<?php

use App\Http\Controllers\{
    ProfileController,
    StudentController,
    AuthController,
    RegisterController,
    AdminController,
    DirectorateController,
    ProctorController,
    EmployeeController,
    NotificationController,
    BlockController,
    RegistrarController
};
use Illuminate\Support\Facades\Route;

/**
 * Authentication Routes
 */
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * Registration Routes
 */
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

/**
 * Employee Management
 */
Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});

/**
 * Static Pages
 */
Route::view('/', 'home')->name('home');
Route::view('/home', 'home');
Route::view('/welcome', 'welcome')->name('welcome');

/**
 * Role-Based Dashboards
 */
Route::view('/directorate_page', 'directorate.directorate')->name('directorate');
Route::view('/coordinator_page', 'coordinator.homepage')->name('coordinator');
Route::view('/proctor_page', 'proctor.homepage')->name('proctor');
Route::view('/registrar_page', 'registrar.homepage')->name('registrar');
Route::view('/student_page', 'students.homepage')->name('student');
Route::view('/maintenance_page', 'maintenance.homepage')->name('maintenance');
Route::view('/admin_page', 'admin.admin')->name('admin');

/**
 * Admin Routes
 */
Route::prefix('admin')->group(function () {
    Route::get('/create-account', [AdminController::class, 'create'])->name('admin.create_account');
    Route::get('/update-account', [AdminController::class, 'update'])->name('admin.update_account');
    Route::get('/reset-account', [AdminController::class, 'reset'])->name('admin.reset_account');
});

/**
 * Directorate Routes
 */
Route::middleware(['auth'])->prefix('directorate')->group(function () {
    Route::get('/', [DirectorateController::class, 'index'])->name('directorate.dashboard');
    Route::get('/reports', [DirectorateController::class, 'viewReports'])->name('directorate.reports');
    Route::get('/placement', [DirectorateController::class, 'viewPlacement'])->name('directorate.placement');
    Route::get('/assign', [DirectorateController::class, 'assignStudent'])->name('directorate.assign');
    Route::get('/proctor', [DirectorateController::class, 'manageProctors'])->name('directorate.proctor');

    // Student Management
    Route::prefix('students')->group(function () {
        Route::get('/', [DirectorateController::class, 'showStudents'])->name('directorate.students.index');
        Route::get('/{id}/edit', [DirectorateController::class, 'editStudent'])->name('directorate.students.edit');
        Route::post('/{id}/update', [DirectorateController::class, 'updateStudent'])->name('directorate.students.update');
        Route::delete('/{id}/delete', [DirectorateController::class, 'deleteStudent'])->name('directorate.students.delete');
    });

    // Block Management
    Route::prefix('blocks')->group(function () {
        Route::get('/', [BlockController::class, 'index'])->name('directorate.blocks');
        Route::get('/create', [BlockController::class, 'create'])->name('directorate.blocks.create');
        Route::post('/', [BlockController::class, 'store'])->name('directorate.blocks.store');
        Route::get('/{id}/edit', [BlockController::class, 'edit'])->name('directorate.blocks.edit');
        Route::put('/{id}', [BlockController::class, 'update'])->name('directorate.blocks.update');
        Route::delete('/{id}', [BlockController::class, 'destroy'])->name('directorate.blocks.destroy');
    });
});

/**
 * Proctor Routes
 */
Route::middleware(['auth'])->prefix('proctor')->group(function () {
    Route::get('/view-rooms', [ProctorController::class, 'viewRooms'])->name('proctor.viewRooms');
});

/**
 * Registrar Routes
 */
Route::prefix('registrar')->group(function () {
    // Registrar Dashboard
    Route::get('/', [RegistrarController::class, 'index'])->name('registrar.dashboard');

    // Student Management
    Route::prefix('students')->group(function () {
        Route::get('/', [RegistrarController::class, 'showStudents'])->name('registrar.students');
        Route::get('/{id}/edit', [RegistrarController::class, 'editStudent'])->name('registrar.students.edit');
        Route::post('/{id}/update', [RegistrarController::class, 'updateStudent'])->name('registrar.students.update');
        Route::delete('/{id}/delete', [RegistrarController::class, 'deleteStudent'])->name('registrar.students.delete');

        // Registration (manual and upload)
        Route::get('/register', [RegistrarController::class, 'showRegistrationForm'])->name('students.register');
        Route::post('/register', [RegistrarController::class, 'storeStudent'])->name('students.store');
        Route::post('/upload', [RegistrarController::class, 'uploadStudents'])->name('students.upload');
    });
});

/**
 * Profile Routes
 */
Route::middleware(['auth'])->prefix('profile')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
});

/**
 * Notifications
 */
Route::middleware(['auth'])->get('/notifications', [NotificationController::class, 'index'])->name('notifications');
