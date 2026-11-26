<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            if (!Schema::hasColumn('jurusans', 'prospek')) {
                $table->string('prospek')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('jurusans', 'gambar')) {
                $table->string('gambar')->nullable()->after('ikon');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            $table->dropColumn(['prospek', 'gambar']);
        });
    }
};