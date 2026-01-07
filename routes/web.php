<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PresenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('auth.login');
// })->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 1. Pengelolaan Akun Pengguna (User)
Route::resource('users', UserController::class);
// Route AJAX untuk Ubah Status Akun (Sesuai Diagram)
Route::patch('users/{id}/status', [UserController::class, 'updateStatus'])->name('users.updateStatus');

// 2. Pengelolaan Data Master (Student, Teacher, Company)
Route::resource('students', StudentController::class);
Route::get('students/create/import', [StudentController::class, 'importView'])->name('students.import.view');
Route::post('students/create/import', [StudentController::class, 'importStore'])->name('students.import.store');
Route::resource('teachers', TeacherController::class);
Route::resource('companies', CompanyController::class);
// Route AJAX untuk Ubah Status Perusahaan (Jika diperlukan)
Route::patch('companies/{id}/status', [CompanyController::class, 'updateStatus'])->name('companies.updateStatus');

// 3. Pengelolaan Monitoring
// Menggunakan resource hanya untuk index, store, dan update sesuai kebutuhan diagram
Route::resource('monitorings', MonitoringController::class)->only(['index', 'store', 'update']);

// 4. Pengelolaan Laporan (Report)
Route::resource('reports', ReportController::class);
// Route AJAX untuk Ubah Status Laporan (Approved/Rejected)
Route::patch('reports/{id}/status', [ReportController::class, 'updateStatus'])->name('reports.updateStatus');

// 5. Pengelolaan Presensi (Presence)
Route::get('presences', [PresenceController::class, 'index'])->name('presences.index');
Route::post('presences', [PresenceController::class, 'store'])->name('presences.store'); // Check-in
Route::patch('presences/{id}/checkout', [PresenceController::class, 'update'])->name('presences.checkout'); // AJAX Check-out
Route::get('presences/{id}', [PresenceController::class, 'show'])->name('presences.show'); // Lihat Lokasi