<?php

namespace App\Models;

use App\Models\User;
use App\Models\Riwayat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asuransi extends Model
{
    use HasFactory;

    protected $guarded = "id";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function riwayat()
    {
        return $this->hasOne(Riwayat::class);
    }
}
