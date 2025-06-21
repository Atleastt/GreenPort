<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\DashboardAuditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\BuktiPendukungController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\VisitasiLapanganController;
use App\Http\Controllers\IndikatorDokumenController;
use App\Http\Controllers\LaporanController;

// Redirect root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin: Manajemen Kriteria
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kriteria', KriteriaController::class);
    });

    // ---------- Halaman Statis/Mockup ----------
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
    Route::get('insert-kriteria-auditor', [App\Http\Controllers\KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('insert-kriteria-auditor', [App\Http\Controllers\KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('insert-sub-kriteria-auditor', [App\Http\Controllers\KriteriaController::class, 'createSubKriteria'])->name('insert.sub.kriteria.auditor');
    Route::post('insert-sub-kriteria-auditor', [App\Http\Controllers\KriteriaController::class, 'storeSubKriteria'])->name('subkriteria.store');
    Route::resource('bukti-pendukung', BuktiPendukungController::class);
    // Route::view('profile-page', 'pages.profile')->name('profile.page'); // Route ini menyebabkan error karena tidak mengirimkan data user
    Route::get('history', [AuditController::class, 'history'])->name('history');
    Route::get('history/{audit}/report', [AuditController::class, 'showReport'])->name('history.report');
    Route::get('pelaporan', [LaporanController::class, 'index'])->name('pelaporan');
    Route::post('pelaporan', [LaporanController::class, 'store'])->name('pelaporan.store');
    Route::view('tambah-pelaporan', 'pages.tambah_pelaporan')->name('tambah.pelaporan');
    Route::get('visitasi-lapangan', [VisitasiLapanganController::class, 'index'])->name('visitasi.lapangan');
    Route::post('visitasi-lapangan', [VisitasiLapanganController::class, 'store'])->name('visitasi.lapangan.store');
// Detail Visitasi Lapangan
Route::get('visitasi-lapangan/{visitasi}', [VisitasiLapanganController::class, 'show'])->name('visitasi.lapangan.show');
// Cancel Visitasi Lapangan
Route::patch('visitasi-lapangan/{visitasi}/cancel', [VisitasiLapanganController::class, 'cancel'])->name('visitasi.lapangan.cancel');
    Route::view('tambah-history', 'pages.tambah_history')->name('tambah.history');

    // CRUD Indikator
    Route::resource('indikator', IndikatorController::class);
    Route::resource('indikator-dokumen', IndikatorDokumenController::class);
});

require __DIR__.'/auth.php';