<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pimpinans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan'); // Contoh: Kepala Sekolah, Wakasek Kurikulum, dll
            $table->string('nip')->nullable();
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(2); // 1 untuk Kepala Sekolah agar selalu paling atas/utama
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pimpinans');
    }
};