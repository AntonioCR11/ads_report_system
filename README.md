## Tugas: Buatlah system pengaduan sederhana dari skema database di atas.

**Keterangan:** Sistem Pengaduan adalah sebuah platform yang dirancang untuk memfasilitasi masyarakat dalam menyampaikan keluhan, masukan, dan pengaduan terkait berbagai aspek layanan dan kondisi di suatu wilayah. Sistem ini bertujuan untuk meningkatkan transparansi, akuntabilitas, dan responsivitas pemerintah dalam menangani isu-isu yang dihadapi oleh warga, serta memperkuat hubungan antara pemerintah dan masyarakat.

Dengan menggunakan Sistem Pengaduan, warga dapat dengan mudah mengajukan pengaduan melalui situs web resmi. Mekanisme ini memberikan akses yang lebih luas dan fleksibel bagi masyarakat untuk menyampaikan masukan mereka, tanpa harus datang langsung ke kantor pemerintah.


    **Ketentuan**:
    1. |v| Implementasikan database seeder untuk insert data dummy category
    2. |v| Implementasikan Laravel Media Library Package untuk upload bukti laporan
    3. |v| Buat tabel laporan menggunakan Yajra DataTables
    4. |v| Buat halaman riwayat perubahan status dari laporan (report tracker)
    5. |v| Buat halaman report log menggunakan Laravel Activity Log Package
    6. |v| Buat dokumentasi, sertakan gambar dari halaman atau fitur yang dibuat
    7. |v| Upload ke GitLab
    8. |v| Batas akhir pengumpulan 04/09/2023 17:00 WIB (http://adslink.id/TaskSubmission)

# Routing : 

## Routing Authentication

    Route::get('login', [IndexController::class, 'masterLogin'])->name("login");
    Route::get('register', [IndexController::class, 'masterRegister'])->name("register");
    Route::post('doLlogin', [IndexController::class, 'doLogin'])->name("doLogin");
    Route::post('doRegister', [IndexController::class, 'doRegister'])->name("doRegister");
    Route::get('logout', [IndexController::class, 'logout'])->name("logout");

## Routing admin

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'masterDashboard'])->name("admin.dashboard");
        Route::prefix('report')->group(function () {
            Route::get('/', [AdminController::class, 'openReport'])->name("admin.open-report");
            Route::get('/{id}', [AdminController::class, 'masterReport'])->name("admin.master-report");
            Route::post('proseslaporan/{id}', [AdminController::class, 'processReport']);
        });
        Route::get('activity', [AdminController::class, 'masterActivity'])->name("admin.activity");
    });

## Routing Reporter
    Route::prefix('reporter')->group(function () {
        Route::get('dashboard', [ReporterController::class, 'reportDashboard'])->name("reporter.dashboard");
        Route::get('form', [ReporterController::class, 'reportForm'])->name('report-form');
        Route::post('form', [ReporterController::class, 'submitReport'])->name('submit-report');
        Route::get('report/{id}', [ReporterController::class, 'masterReport'])->name("reporter.master-report");
    });

### Flow aplikasi

Authentication :

Pelapor pada awalnya akan melakukan registrasi, setelah akun terbuat, maka pelapor akan masuk menggunakan email mereka.  

<img width="1280" alt="image" src="https://github.com/AntonioCR11/ads_report_system/assets/99940538/8f75b8d5-534c-49fd-8b1e-f9b5ebd5b982">
<img width="1280" alt="image" src="https://github.com/AntonioCR11/ads_report_system/assets/99940538/f364045e-4d11-4c25-b62e-bd51946bbb30">


Halaman Reporter : 
Pelapor memiliki 3 page yaitu:
1. dashboard dimana pelapor dapat melihat Laporan yang telah mereka ajukan
2. form dimana pelapor dapat mengisi form dan mengajukan laporan mereka
3. report-detail dimana pelapor dapat melihat detail Laporan yang telah mereka ajukan

<img width="1280" alt="image" src="https://github.com/AntonioCR11/ads_report_system/assets/99940538/ac2810ee-7887-485f-9ab7-b8df6a89e92f">
<img width="1280" alt="image" src="https://github.com/AntonioCR11/ads_report_system/assets/99940538/282f8436-22df-4f7f-b492-99cc52b9c2c7">
<img width="1280" alt="image" src="https://github.com/AntonioCR11/ads_report_system/assets/99940538/0efcb0ca-71ba-4559-a592-67518e5d81be">

Halaman Admin : 
Admin memiliki 3 page yaitu:
1. dashboard dimana admin dapat melihat semua laporan yang ada
2. report-detail dimana admin dapat memproses laporan yang ada apabila status pending atau admin merupakan penanggung jawab laporan
3. activity dimana admin dapat melihat semua activity admin yang ada
<img width="1280" alt="image" src="https://github.com/AntonioCR11/ads_report_system/assets/99940538/9dee10b0-0a8b-45f5-b566-8d67be5c951c">
<img width="1280" alt="image" src="https://github.com/AntonioCR11/ads_report_system/assets/99940538/01ef8409-8369-4e35-a030-d0e98d4ebb21">
<img width="1280" alt="image" src="https://github.com/AntonioCR11/ads_report_system/assets/99940538/caafc52e-bb66-4555-a2ff-79e7f97fff6f">

