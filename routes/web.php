<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\DashboardAuditorController;
use App\Http\Controllers\IndikatorController;

// Redirect root ke halaman login statis
Route::get('/', function () {
    return redirect()->route('login.page');
});

// Halaman login statis (publik)
Route::view('login-page', 'pages.login')->name('login.page');

/*
|-----------------------------------
| Rute yang Memerlukan Autentikasi
|-----------------------------------
*/
Route::middleware([
    'auth',
    'verified',
])->group(function () {

    // Dashboard default Jetstream
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin: Manajemen Kriteria
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kriteria', KriteriaController::class);
    });

    // ---------- Halaman Statis/Mockup ----------
    Route::get('dashboard-auditor', [DashboardAuditorController::class, 'index'])->name('dashboard.auditor');
    Route::view('dashboard-auditee', 'pages.dashboard_auditee')->name('dashboard.auditee');
    Route::get('daftar-audit-auditor', [AuditController::class, 'index'])->name('daftar.audit.auditor');
    Route::view('detail-audit-auditee', 'pages.detail_audit_auditee')->name('detail.audit.auditee');
    Route::get('form-buat-audit-auditor', [AuditController::class, 'create'])->name('form.buat.audit.auditor');
    Route::post('audits', [AuditController::class, 'store'])->name('audits.store');
    Route::get('audits/{audit}', [AuditController::class, 'show'])->name('audits.show');
    Route::get('audits/{audit}/edit', [AuditController::class, 'edit'])->name('audits.edit');
    Route::patch('audits/{audit}', [AuditController::class, 'update'])->name('audits.update');
    Route::delete('audits/{audit}', [AuditController::class, 'destroy'])->name('audits.destroy');
    Route::view('laporan-audit-contoh', 'pages.laporan_audit_contoh')->name('laporan.audit.contoh');
    Route::view('forget-password-page', 'pages.forget_password')->name('forget.password.page');
    Route::view('tambah-dokumen', 'pages.tambah_dokumen')->name('tambah.dokumen');
    Route::view('indikator-dokumen', 'pages.indikator_dokumen')->name('indikator.dokumen');
    Route::view('insert-kriteria-auditor', 'pages.insert_kriteria_auditor')->name('insert.kriteria.auditor');
    Route::view('insert-sub-kriteria-auditor', 'pages.insert_sub_kriteria_auditor')->name('insert.sub.kriteria.auditor');
    Route::view('bukti-pendukung-auditee', 'pages.bukti_pendukung_auditee')->name('bukti.pendukung.auditee');
    Route::view('profile-page', 'pages.profile')->name('profile.page');
    Route::view('history', 'pages.history')->name('history');
    Route::view('lihat-history', 'pages.lihat_history')->name('lihat.history');
    Route::view('pelaporan', 'pages.pelaporan')->name('pelaporan');
    Route::view('tambah-pelaporan', 'pages.tambah_pelaporan')->name('tambah.pelaporan');
    Route::view('visitasi-lapangan', 'pages.visitasi_lapangan')->name('visitasi.lapangan');
    Route::view('tambah-history', 'pages.tambah_history')->name('tambah.history');

    // CRUD Indikator
    Route::resource('indikator', IndikatorController::class);
});

/*
|--------------------------------------------------------------------------
| Auth Scaffolding Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';