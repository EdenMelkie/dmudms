<?php

use App\Http\Controllers\{
    ProfileController,
    StudentController,
    AuthController,
    RegisterController,
    AdminController,
    DirectorateController,
    ProctorController,
    CoordinatorController,
    NotificationController,
    BlockController,
    RegistrarController,
    MaintainerController,
    PlacementController
};
use Illuminate\Support\Facades\Route;

/**
 * Static Pages
 * Route::view('/view-student-assignment', 'welcome')->name('view_student_assignment');
 */
Route::get('/api/rooms', [PlacementController::class, 'apiAvailableRooms']);
Route::view('/', 'home')->name('home');
Route::view('/home', 'home');
Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/about', 'about')->name('about');
Route::view('/help', 'help')->name('help');

/**
 * Authentication Routes
 */
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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
 * Profile Routes
 */
Route::prefix('profile')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
});

/**
 * Admin Routes
 */
Route::prefix('admin')->group(function () {
    Route::get('/create-account', [RegisterController::class, 'create'])->name('admin.create_account');
    Route::get('/update-account', [RegisterController::class, 'update'])->name('admin.update_account');
    Route::get('/reset-account', [AdminController::class, 'reset'])->name('admin.reset_account');

    Route::prefix('employees')->group(function () {
        Route::get('/', [RegisterController::class, 'index'])->name('employees.index');
        Route::get('/store', [RegisterController::class, 'store'])->name('employees.store');
        Route::get('/{employee}', [RegisterController::class, 'show'])->name('employees.show');
        Route::get('/{employee}/edit', [RegisterController::class, 'edit'])->name('employees.edit');
        Route::put('/{employee}', [RegisterController::class, 'update'])->name('employees.update');
        Route::delete('/{employee}', [RegisterController::class, 'destroy'])->name('employees.destroy');
    });
});

/**
 * Registration Routes
 */
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/invalid', fn() => view('layouts.invalid'));


/**
 * Directorate Routes
 */
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::prefix('directorate')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('directorate.dashboard');
    Route::get('/reports', [StudentController::class, 'viewReports'])->name('directorate.reports');
    Route::get('/placement', [StudentController::class, 'viewPlacement'])->name('directorate.placement');
    Route::get('/proctor', [StudentController::class, 'manageProctors'])->name('directorate.proctor');

    // Student Management
    Route::prefix('students')->group(function () {
        Route::get('/', [PlacementController::class, 'showStudents'])->name('directorate.students.index');
        // Route::get('/{id}/edit', [DirectorateController::class, 'editStudent'])->name('directorate.students.edit');
        // Route::post('/{id}/update', [DirectorateController::class, 'updateStudent'])->name('directorate.students.update');
        // Route::delete('/{id}/delete', [DirectorateController::class, 'deleteStudent'])->name('directorate.students.delete');

        // Route::post('/assign', [DirectorateController::class, 'assignStudent'])->name('directorate.student.assign');

        // // Student Assignment
        // Route::post('/{student_id}/assign', [DirectorateController::class, 'assignStudent'])->name('directorate.student.assign');
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
 * Placement Routes
 */
Route::prefix('placements')->name('placements.')->group(function () {
    Route::get('/', [PlacementController::class, 'index'])->name('index');
    Route::post('assign/{student_id}', [PlacementController::class, 'assignStudentToPlacement'])->name('assignStudentToPlacement');
    Route::post('{student_id}/unassign', [PlacementController::class, 'unassign'])->name('unassign');
    Route::post('{student_id}/replace', [PlacementController::class, 'replace'])->name('replace');
    Route::post('auto-assign', [PlacementController::class, 'autoAssignStudents'])->name('autoAssignStudents');
    Route::get('/search', [PlacementController::class, 'searchForm'])->name('search.form');
    Route::post('/search', [PlacementController::class, 'search'])->name('search');
});

/**
 * Coordinator Routes
 */
Route::prefix('coordinator')->group(function () {
    Route::get('/placement', [CoordinatorController::class, 'viewAssignments'])->name('coordinator.placement');
    Route::get('/proctor', [CoordinatorController::class, 'manageProctors'])->name('coordinator.proctor');
    Route::get('/blocks', [CoordinatorController::class, 'viewBlocks'])->name('coordinator.blocks');
    Route::get('/proctor/assign', [CoordinatorController::class, 'assignProctors'])->name('coordinator.proctor.assign');
});



/**
 * Registrar Routes
 */
Route::prefix('registrar')->group(function () {
    Route::get('/', [RegistrarController::class, 'index'])->name('registrar.dashboard');
    // View notifications
    Route::get('/notifications', [RegistrarController::class, 'notify'])->name('registrar.notify');
    // Store new notification
    Route::post('/notifications', [RegistrarController::class, 'storeNotification'])->name('registrar.notifications.store');
    Route::delete('/notifications/{id}', [RegistrarController::class, 'deleteNotification'])->name('registrar.notifications.delete');

    Route::prefix('students')->group(function () {
        Route::get('/', [RegistrarController::class, 'showStudents'])->name('registrar.students');
        Route::get('/{id}/edit', [RegistrarController::class, 'editStudent'])->name('registrar.students.edit');
        Route::put('/students/{id}/update', [RegistrarController::class, 'updateStudent'])->name('registrar.students.update');
        Route::delete('/{id}/delete', [RegistrarController::class, 'deleteStudent'])->name('registrar.students.delete');
        Route::get('/register', [RegistrarController::class, 'showRegistrationForm'])->name('students.register');
        Route::post('/register', [RegistrarController::class, 'storeStudent'])->name('students.store');
        Route::get('/upload', [RegistrarController::class, 'showUploadForm'])->name('students.upload.form');
        Route::post('/upload', [RegistrarController::class, 'uploadStudents'])->name('students.upload');
    });
});

/**
 * Maintenance Routes
 */
Route::get('/maintainer', [MaintainerController::class, 'index'])->name('maintainer');

/**
 * Notification Routes
 */
Route::get('/students', [StudentController::class, 'index'])->name('students');
