<?php

namespace App\Models;

use App\Models\Riwayat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_surat',
    ];

    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }
}
