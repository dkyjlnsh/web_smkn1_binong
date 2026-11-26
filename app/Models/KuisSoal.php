<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KuisSoal extends Model
{
    protected $fillable = ['pertanyaan', 'urutan'];

    public function opsis(): HasMany
    {
        return $this->hasMany(KuisOpsi::class, 'kuis_soal_id');
    }
}