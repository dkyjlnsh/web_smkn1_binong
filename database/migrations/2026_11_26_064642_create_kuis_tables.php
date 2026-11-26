<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kuis_soals', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });

        Schema::create('kuis_opsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuis_soal_id')->constrained('kuis_soals')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->string('teks_opsi');
            $table->integer('bobot')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis_opsis');
        Schema::dropIfExists('kuis_soals');
    }
};