<?php

namespace App\Models;

use App\Models\User;
use App\Models\Riwayat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kematian extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'nama_pasien', 'no_rekam_medis', 'no_telp', 'ktp', 'kk'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function riwayat()
    {
        return $this->hasOne(Riwayat::class);
    }
}
