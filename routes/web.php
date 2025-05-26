<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login.page'); // Mengarahkan ke halaman login statis
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Routes untuk UI (Sebelumnya Screenshot UI)
// Route::prefix('screenshots')->name('screenshots.')->group(function () { // Prefix dan nama grup dihapus
    Route::get('login-page', function () { // Path diubah, misal 'login' jadi 'login-page' untuk menghindari konflik jika ada route /login lain
        return view('pages.login'); // Path view diubah
    })->name('login.page'); // Nama route diubah

    Route::get('dashboard-auditor', function () {
        return view('pages.dashboard_auditor');
    })->name('dashboard.auditor');

    Route::get('dashboard-auditee', function () {
        return view('pages.dashboard_auditee');
    })->name('dashboard.auditee');

    Route::get('daftar-audit-auditor', function () {
        return view('pages.daftar_audit_auditor');
    })->name('daftar.audit.auditor');

    Route::get('detail-audit-auditee', function () {
        return view('pages.detail_audit_auditee');
    })->name('detail.audit.auditee');

    Route::get('form-buat-audit-auditor', function () {
        return view('pages.form_buat_audit_auditor');
    })->name('form.buat.audit.auditor');

    Route::get('laporan-audit-contoh', function () {
        return view('pages.laporan_audit_contoh');
    })->name('laporan.audit.contoh');

    Route::get('forget-password-page', function () { // Path diubah
        return view('pages.forget_password');
    })->name('forget.password.page'); // Nama route diubah

    Route::get('tambah-dokumen', function () {
        return view('pages.tambah_dokumen');
    })->name('tambah.dokumen');

    Route::get('indikator-dokumen', function () {
        return view('pages.indikator_dokumen');
    })->name('indikator.dokumen');

    Route::get('insert-kriteria-auditor', function () {
        return view('pages.insert_kriteria_auditor');
    })->name('insert.kriteria.auditor');

    Route::get('insert-sub-kriteria-auditor', function () {
        return view('pages.insert_sub_kriteria_auditor');
    })->name('insert.sub.kriteria.auditor');

    Route::get('bukti-pendukung-auditee', function () {
        return view('pages.bukti_pendukung_auditee');
    })->name('bukti.pendukung.auditee');

    Route::get('profile-page', function () { // Path diubah
        return view('pages.profile');
    })->name('profile.page'); // Nama route diubah

    Route::get('history', function () {
        return view('pages.history');
    })->name('history');

    Route::get('lihat-history', function () {
        return view('pages.lihat_history');
    })->name('lihat.history');

    Route::get('pelaporan', function () {
        return view('pages.pelaporan');
    })->name('pelaporan');

    Route::get('tambah-pelaporan', function () {
        return view('pages.tambah_pelaporan');
    })->name('tambah.pelaporan');

    Route::get('visitasi-lapangan', function () {
        return view('pages.visitasi_lapangan');
    })->name('visitasi.lapangan');

    Route::get('tambah-history', function () { // Path diubah
        return view('pages.tambah_history');
    })->name('tambah.history'); // Nama route diubah
// }); // Akhir grup dihapus
