<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_kepatuhan_id')->constrained('checklist_kepatuhans')->onDelete('cascade');
            $table->foreignId('indikator_id')->constrained('indikators');
            $table->text('jawaban_auditee')->nullable();
            $table->decimal('skor_final_auditor', 5, 2)->nullable();
            $table->text('komentar_auditor')->nullable();
            $table->enum('status_verifikasi', ['Disetujui', 'Ditolak'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_checklists');
    }
};
