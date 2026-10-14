<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkemaSertifikasi extends Model
{
    protected $table = 'skema';

    protected $fillable = [
        'kode_skema',
        'nama_skema',
        'deskripsi',
    ];

    // User (peserta) yang memilih skema ini
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'skema_id');
    }
}