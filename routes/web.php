<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReporterController;
use Illuminate\Support\Facades\Route;

/*
    **Ketentuan**:
    1. |v| Implementasikan database seeder untuk insert data dummy category
    2. |v| Implementasikan Laravel Media Library Package untuk upload bukti laporan
    3. |v| Buat tabel laporan menggunakan Yajra DataTables
    4. |v| Buat halaman riwayat perubahan status dari laporan (report tracker)
    5. |v| Buat halaman report log menggunakan Laravel Activity Log Package
    6. || Buat dokumentasi, sertakan gambar dari halaman atau fitur yang dibuat
    7. || Upload ke GitLab
    8. || Batas akhir pengumpulan 04/09/2023 17:00 WIB (http://adslink.id/TaskSubmission)
*/

Route::get('/', function () {
    return redirect()->route("login");
});

# Authentication
Route::get('login', [IndexController::class, 'masterLogin'])->name("login");
Route::post('doLlogin', [IndexController::class, 'doLogin'])->name("doLogin");
Route::get('logout', [IndexController::class, 'logout'])->name("logout");

# Routing admin
Route::prefix('admin')->group(function () {
    // report list & detail
    Route::get('dashboard', [AdminController::class, 'masterDashboard'])->name("admin.dashboard");

    Route::prefix('report')->group(function () {
        // ajax report
        Route::get('/', [AdminController::class, 'openReport'])->name("admin.open-report");
        // non-ajax report
        Route::get('/{id}', [AdminController::class, 'masterReport'])->name("admin.master-report");
        // proses report (update status report)
        Route::post('proseslaporan/{id}', [AdminController::class, 'processReport']);
    });

    // activity log
    Route::get('activity', [AdminController::class, 'masterActivity'])->name("admin.activity");
});

# Form Report
Route::get('report', [ReporterController::class, 'reportForm'])->name('report-form');
Route::post('report', [ReporterController::class, 'submitReport'])->name('submit-report');
