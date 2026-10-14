<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Peserta extends Model
{
    protected $table = 'peserta';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'skema_id',
            
    ];

    public function skema()
    {
        return $this->belongsTo(
            SkemaSertifikasi::class,
            'skema_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}