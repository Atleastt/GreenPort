<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->string('judul_audit');
            $table->text('deskripsi_audit');
            $table->foreignId('auditor_id')->constrained('users');
            $table->foreignId('auditee_id')->constrained('users');
            $table->date('tanggal_jadwal');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status_audit', ['Dijadwalkan', 'Berlangsung', 'Selesai']);
            $table->decimal('skor_keseluruhan', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
