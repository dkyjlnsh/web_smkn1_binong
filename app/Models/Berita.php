<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'isi',
        'gambar',
        'status',
        'jadwal_tayang',
    ];

    protected $casts = [
        'jadwal_tayang' => 'datetime',
    ];

    // Scope: Hanya berita berstatus 'terbit' dan waktunya sudah tiba
    public function scopeTayang($query)
    {
        return $query->where('status', 'terbit')
            ->where(function ($q) {
                $q->whereNull('jadwal_tayang')
                  ->orWhere('jadwal_tayang', '<=', now());
            });
    }
}