<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buktis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_checklist_id')->constrained('item_checklists')->onDelete('cascade');
            $table->foreignId('pengguna_unggah_id')->constrained('users');
            $table->string('nama_file');
            $table->string('path_file');
            $table->string('tipe_file');
            $table->integer('ukuran_file');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buktis');
    }
};
