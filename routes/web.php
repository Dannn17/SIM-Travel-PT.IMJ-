<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DriveScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\TestingController;


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth','role:admin|super_admin'])->group(function () {
    Route::get('/admin-dashboard', [DashboardController::class, 'index']);
    Route::get('/order-statistics', [DashboardController::class, 'getOrderStatistics']);
    Route::get('/get-sales-profit', [DashboardController::class, 'getSalesProfit']);

    Route::resource('services', ServiceController::class)->except(['show']);
    Route::delete('/services', [ServiceController::class, 'destroy'])->name('services.bulkDelete');

    // Skripsi - Data Latih
    Route::resource('trainings', TrainingController::class);
    Route::post('trainings/import', [TrainingController::class, 'import'])->name('trainings.import');
    Route::post('trainings/truncate', [TrainingController::class, 'truncate'])->name('trainings.truncate');

    // Pengujian Metode
    Route::get('/testing', [TestingController::class, 'index'])->name('testing.index');
    Route::post('/testing/run', [TestingController::class, 'runTest'])->name('testing.run');
    Route::get('/testing/blackbox', [TestingController::class, 'blackbox'])->name('testing.blackbox');

    Route::resource('roles', RoleController::class);
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.bulkDelete');
    
    Route::resource('users', UserController::class);
    Route::delete('/users', [UserController::class, 'destroy'])->name('users.bulkDelete');
});

Route::middleware(['auth','role:admin|super_admin|pegawai'])->group(function () {
    Route::get('/api/schedules', [DashboardController::class, 'getSchedules']);

    Route::resource('drivers', DriverController::class);
    Route::delete('/drivers', [DriverController::class, 'destroy'])->name('drivers.bulkDelete');

    Route::resource('vehicles', VehicleController::class);
    Route::delete('/vehicles', [VehicleController::class, 'destroy'])->name('vehicles.bulkDelete');
    
    Route::resource('drive-schedules', DriveScheduleController::class);
    Route::delete('/drive-schedules', [DriveScheduleController::class, 'destroy'])->name('drive-schedules.bulkDelete');
    
    Route::resource('service-schedules', ServiceScheduleController::class);
    Route::delete('/service-schedules', [ServiceScheduleController::class, 'destroy'])->name('service-schedules.bulkDelete');
    
    Route::resource('bookings', BookingController::class);
    Route::delete('/bookings', [BookingController::class, 'destroy'])->name('bookings.bulkDelete');
    Route::post('/booking/{id}/deposit', [BookingController::class, 'updateDeposit'])->name('booking.deposit');
    Route::post('/booking/{id}/paid', [BookingController::class, 'markAsPaid'])->name('booking.paid');
    Route::get('bookings/{id}/download', [BookingController::class, 'downloadPdf'])->name('booking.downloadPdf');
    Route::get('/get-available-vehicles', [BookingController::class, 'getAvailableVehicles']);
    Route::get('/get-vehicle-status', [BookingController::class, 'getVehicleStatus']);

    // Kelola Data Penyewa
    Route::get('/customers/export', [CustomerController::class, 'export'])->name('customers.export');
    Route::resource('customers', CustomerController::class);
    Route::delete('/customers', [CustomerController::class, 'destroy'])->name('customers.bulkDelete');
    Route::get('/customers/{customer}', [CustomerController::class, 'show']);
    Route::post('customers/import', [CustomerController::class, 'import'])->name('customers.import');
    Route::post('/customers/import', [CustomerController::class, 'import'])->name('customers.import');

    // Proses Klasifikasi
    Route::get('classification', [ClassificationController::class, 'index'])->name('classification.index');
    Route::post('classification/process', [ClassificationController::class, 'process'])->name('classification.process');
    Route::post('classification/bulk', [ClassificationController::class, 'bulkProcess'])->name('classification.bulkProcess');
    Route::get('classification/{id}', [ClassificationController::class, 'show'])->name('classification.show');
    Route::post('classification/verify/{id}', [ClassificationController::class, 'verify'])->name('classification.verify');

    // Membuat Laporan
    Route::get('/services-report', [ServiceController::class, 'generateReport'])->name('service.report');

    // Profile & Settings
    Route::get('/profile', [AuthController::class, 'show'])->name('profile');
    Route::post('/profile/update-photo', [AuthController::class, 'updateProfilePhoto'])->name('profile.update-photo');
});

Route::middleware(['auth','role:pegawai'])->group(function () {
    Route::get('/karyawan-dashboard', [DashboardController::class, 'karyawanIndex'])->name('karyawan.dashboard');
});
//buat role baru juga boleh

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('komponen.apps-calendar');
})->name('register.form');
// Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.password');
    Route::put('/update-profile', [AuthController::class, 'update'])->name('profile.update');
});
