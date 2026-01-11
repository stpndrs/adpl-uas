<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    StudentController,
    TeacherController,
    CompanyController,
    MonitoringController,
    SubmissionController,
    StudentActivityController,
    StudentSubmissionController,
    TeacherMonitoringController,
    CompanyManagementController,
    ReportController,
    PresenceController
};
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public & Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Semua Role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Role: 1)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:1'])->group(function () {
    // 1. User Management
    Route::resource('users', UserController::class);
    Route::patch('users/{id}/status', [UserController::class, 'updateStatus'])->name('users.updateStatus');

    // 2. Data Master (Siswa, Guru, Instansi)
    // Student
    Route::get('students/create/import', [StudentController::class, 'importView'])->name('students.import.view');
    Route::post('students/create/import', [StudentController::class, 'importStore'])->name('students.import.store');
    Route::get('students/download/import', [StudentController::class, 'downloadTemplate'])->name('students.import.download');
    Route::resource('students', StudentController::class);

    // Teacher
    Route::get('teachers/create/import', [TeacherController::class, 'importView'])->name('teachers.import.view');
    Route::post('teachers/create/import', [TeacherController::class, 'importStore'])->name('teachers.import.store');
    Route::get('teachers/download/import', [TeacherController::class, 'downloadTemplate'])->name('teachers.import.download');
    Route::resource('teachers', TeacherController::class);

    // Company
    Route::get('companies/create/import', [CompanyController::class, 'importView'])->name('companies.import.view');
    Route::post('companies/create/import', [CompanyController::class, 'importStore'])->name('companies.import.store');
    Route::get('companies/download/import', [CompanyController::class, 'downloadTemplate'])->name('companies.import.download');
    Route::resource('companies', CompanyController::class);
    Route::patch('companies/{id}/status', [CompanyController::class, 'updateStatus'])->name('companies.updateStatus');

    // 3. Submissions (Admin View)
    Route::prefix('submissions')->name('submissions.')->group(function () {
        Route::get('/', [SubmissionController::class, 'index'])->name('index');
        Route::get('/create', [SubmissionController::class, 'create'])->name('create');
        Route::post('/', [SubmissionController::class, 'store'])->name('store');
        Route::post('/{id}/approve', [SubmissionController::class, 'approve'])->name('approve');
        Route::get('/{id}/edit', [SubmissionController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SubmissionController::class, 'update'])->name('update');
        Route::delete('/{id}', [SubmissionController::class, 'destroy'])->name('destroy');
    });

    // 4. Monitoring (Admin View)
    Route::get('/monitorings/import', [MonitoringController::class, 'importView'])->name('monitoring.import.view');
    Route::post('/monitorings/import', [MonitoringController::class, 'importStore'])->name('monitoring.import.store');
    Route::get('/monitorings/{id}/attendance', [MonitoringController::class, 'attendance'])->name('monitoring.attendance');
    Route::get('/monitorings/{id}/report', [MonitoringController::class, 'report'])->name('monitoring.report');
    Route::resource('monitorings', MonitoringController::class);

    // 5. Reports & Presences (Global Admin Access)
    Route::resource('reports', ReportController::class);
    Route::patch('reports/{id}/status', [ReportController::class, 'updateStatus'])->name('reports.updateStatus');

    Route::get('presences', [PresenceController::class, 'index'])->name('presences.index');
    Route::post('presences', [PresenceController::class, 'store'])->name('presences.store');
    Route::patch('presences/{id}/checkout', [PresenceController::class, 'update'])->name('presences.checkout');
    Route::get('presences/{id}', [PresenceController::class, 'show'])->name('presences.show');
});

/*
|--------------------------------------------------------------------------
| Guru Routes (Role: 2)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:2'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/monitoring', [TeacherMonitoringController::class, 'index'])->name('monitoring.index');
    Route::get('/monitoring/{id}', [TeacherMonitoringController::class, 'show'])->name('monitoring.show');
    Route::post('/report/{id}/comment', [TeacherMonitoringController::class, 'addComment'])->name('report.comment');
});

/*
|--------------------------------------------------------------------------
| Instansi Routes (Role: 3)
|--------------------------------------------------------------------------
*/
// dd(Auth::user());   
Route::middleware(['auth', 'role:3'])->prefix('company')->name('company.')->group(function () {
    Route::get('/monitoring', [CompanyManagementController::class, 'index'])->name('monitoring.index');
    Route::get('/monitoring/{id}', [CompanyManagementController::class, 'show'])->name('monitoring.show');
});

/*
|--------------------------------------------------------------------------
| Siswa Routes (Role: 4)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:4'])->prefix('student')->name('student.')->group(function () {
    // Pengajuan PKL (Logika Index & Status di sini)
    Route::get('/submissions', [StudentSubmissionController::class, 'index'])->name('submissions.index');
    Route::post('/submissions', [StudentSubmissionController::class, 'store'])->name('submissions.store');

    // Aktivitas (Presensi & Laporan)
    Route::get('/activities', [StudentActivityController::class, 'index'])->name('activities.index');
    Route::get('/activities/create', [StudentActivityController::class, 'create'])->name('activities.create');
    Route::post('/activities', [StudentActivityController::class, 'store'])->name('activities.store');
    Route::get('/activities/{id}', [StudentActivityController::class, 'show'])->name('activities.show');

    Route::resource('reports', StudentReportController::class)->only(['index', 'create', 'store', 'show']);
});
