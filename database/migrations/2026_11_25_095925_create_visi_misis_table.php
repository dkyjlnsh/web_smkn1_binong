<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['visi', 'misi'])->default('misi');
            $table->text('isi');
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visi_misis');
    }
};