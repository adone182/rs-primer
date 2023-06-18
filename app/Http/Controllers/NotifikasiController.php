<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\NotifikasiDiterima;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $notifikasi = $user->unreadNotifications()->get();
        $unreadCount = $notifikasi->count();

        return view('Surat.RIWAYAT.pesan', compact('notifikasi', 'unreadCount'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function showNotifications()
    {
        $user = Auth::user();

        // Menandai notifikasi-notifikasi yang belum dibaca sebagai telah dibaca
        // $user->unreadNotifications->markAsRead();

        // Logika lainnya untuk menampilkan tampilan notifikasi

        $notifikasi = $user->notifications();

        return view('Surat.RIWAYAT.pesan', compact('notifikasi', 'user'));
    }

    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        $notifikasiId = $request->input('notifikasi_id');

        $notifikasi = $user->notifications()->findOrFail($notifikasiId);
        $notifikasi->markAsRead();

        event(new NotifikasiDibaca($user));

        return response()->json(['status' => 'success']);
    }

    public function unreadNotifications()
    {
        $user = Auth::user();
        return $user->unreadNotifications();
    }

    public function kirimNotifikasi(Request $request)
    {
        // Lakukan logika Anda untuk membuat notifikasi dan menghitung jumlah notifikasi yang belum dibaca
        $unreadCount = 10; // Ganti dengan logika Anda
        
        event(new NotifikasiDiterima($unreadCount));

        return response()->json(['status' => 'success']);
    }

}
