<?php

namespace App\Models;

use App\Models\Riwayat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifikasi extends Model
{
    use HasFactory;

    protected $guarded ='id';
    protected $table = 'notifikasis';

    public function riwayat()
    {
        return $this->belongsTo(Riwayat::class);
    }
}
