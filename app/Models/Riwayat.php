<?php

namespace App\Models;

// use Illuminate\Foundation\Auth\User;
use App\Models\User;
use App\Models\Lahir;
use App\Models\Medis;
use App\Models\Surat;
use App\Models\Visum;
use App\Models\Vaksin;
use App\Models\Asuransi;
use App\Models\Kematian;
use App\Models\Imunisasi;
use App\Models\Notifikasi;
use App\Models\RawatJalan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riwayat extends Model
{
    use HasFactory;


    protected $fillable = [
    'user_id',
    'surat_id',
    'vaksin_id',
    'imunisasi_id',
    'visum_id',
    'medis_id',
    'lahir_id',
    'rawat_jalan_id',
    'kematian_id',
    'asuransi_id',
    'jenis_surat',
    'tanggal_pengajuan',
    'status',
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

    public function imunisasi()
    {
        return $this->belongsTo(Imunisasi::class);
    }
    public function asuransi()
    {
        return $this->belongsTo(Asuransi::class);
    }
    public function kematian()
    {
        return $this->belongsTo(Kematian::class);
    }
    public function lahir()
    {
        return $this->belongsTo(Lahir::class);
    }
    public function medis()
    {
        return $this->belongsTo(Medis::class);
    }
    public function rawat_jalan()
    {
        return $this->belongsTo(RawatJalan::class);
    }
    public function visum()
    {
        return $this->belongsTo(Visum::class);
    }

    protected $table = 'riwayats';

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
