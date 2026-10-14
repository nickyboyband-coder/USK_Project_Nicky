<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    protected $table = 'peserta';

    protected $fillable = ['user_id', 'nik', 'no_hp', 'skema_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function skema(): BelongsTo
    {
        return $this->belongsTo(SkemaSertifikasi::class, 'skema_id');
    }
}