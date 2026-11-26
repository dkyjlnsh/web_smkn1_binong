<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KuisOpsi extends Model
{
    protected $fillable = ['kuis_soal_id', 'jurusan_id', 'teks_opsi', 'bobot'];

    public function soal(): BelongsTo
    {
        return $this->belongsTo(KuisSoal::class, 'kuis_soal_id');
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}