<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonInterface;
// setlocale(LC_TIME, 'id_ID');
// Carbon::setLocale('id');

use App\Models\Riwayat;
use App\Models\Notifikasi;
use App\Http\Requests\StoreRiwayatRequest;
use App\Http\Requests\UpdateRiwayatRequest;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $riwayats = Riwayat::select('riwayats.id as no', 'vaksins.nama_pasien', 'vaksins.no_rekam_medis', 'vaksins.no_telp','riwayats.jenis_surat', 'riwayats.tanggal_pengajuan', 'riwayats.status')
        //     ->join('vaksins', 'riwayats.id', '=', 'vaksins.id')
        //     ->get();
        $user = Auth::user();
        $riwayats = Riwayat::where('user_id', $user->id)
            ->with(['vaksin', 'visum', 'imunisasi', 'rawat_jalan', 'lahir', 'kematian', 'medis', 'asuransi'])
            ->get();

        return view('Surat.RIWAYAT.index', compact('riwayats'));

        // Konversi format tanggal menggunakan Carbon
        foreach ($riwayats as $riwayat) {
            $tanggalPengajuan = Carbon::parse($riwayat->tanggal_pengajuan);
            $riwayat->tanggal_pengajuan = $tanggalPengajuan->isoFormat('dddd, D MMMM Y');
        }

        return view('Surat.RIWAYAT.index', compact('riwayats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiwayatRequest $request)
    {
        // Simpan riwayat vaksin
        $riwayat = new Riwayat;
        // Mengisi atribut-atribut riwayat vaksin
        $riwayat->save();

        // Buat notifikasi pengajuan berhasil dikirim
        $pesan = 'Pengajuan Anda berhasil dikirim';
        $this->createNotifikasi($riwayat, $pesan);

        // Redirect ke halaman yang sesuai
        return redirect()->route('nama_rute');
    }

    /**
     * Display the specified resource.
     */
    public function show(Riwayat $riwayat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiwayatRequest $request, Riwayat $riwayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riwayat $riwayat)
    {
        //
    }

    /**
     * Create a notification based on the provided data.
     */
    private function createNotifikasi($riwayat, $pesan, $link = null)
    {
        $notifikasi = new Notifikasi();
        $notifikasi->user_id = Auth::id();
        $notifikasi->riwayat_id = $riwayat->id;
        $notifikasi->pesan = $pesan;
        $notifikasi->link = $link;
        $notifikasi->save();
    }
}
