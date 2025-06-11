<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indikators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subkriteria_id')->constrained('subkriterias')->onDelete('cascade');
            $table->text('teks_indikator');
            $table->decimal('bobot_indikator', 5, 2);
            $table->decimal('poin_maks_indikator', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indikators');
    }
};
