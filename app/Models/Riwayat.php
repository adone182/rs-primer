<?php

namespace App\Models;

// use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Vaksin;
use App\Models\User;

class Riwayat extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id', 'surat_id', 'vaksin_id', 'tanggal_pengajuan', 'status','jenis_surat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function vaksin()
    {
        return $this->belongsTo(Vaksin::class);
    }
}
