<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vaksin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifikasi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'title',
        'message',
        'sender',
        'user_id',
        'vaksin_id'
    ];

    /**
     * Get the user associated with the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vaksin()
    {
        return $this->belongsTo(Vaksin::class);
    }
}
