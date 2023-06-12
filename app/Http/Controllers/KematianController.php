<?php

namespace App\Http\Controllers;

use App\Models\Kematian;
use App\Models\Surat;
use Illuminate\Http\Request;
use App\Http\Controllers\KematianController;
use App\Http\Requests\StoreKematianRequest;
use App\Http\Requests\UpdateKematianRequest;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suratKematian = Surat::where('jenis_surat', 'kematian')->first();
        return view('Surat.Kematian.create', compact('suratKematian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string',
            'no_rekam_medis' => 'required|numeric|max:12',
            'no_telp' => 'required|numeric|max:12',
            'ktp' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf|max:1024',
        ]);

        // Simpan file KTP, KK, dan SKCK yang diunggah
        $ktpPath = $validatedData['ktp']->store('surat_kematian');
        $kkPath = $validatedData['kk']->store('surat_kematian');

        // Simpan pengajuan surat vaksin ke tabel "vaksins"
        $kematian = Kematian::create([
            'user_id' => auth()->user()->id,
            'nama_pasien' => $validatedData['nama_pasien'],
            'no_rekam_medis' => $validatedData['no_rekam_medis'],
            'no_telp' => $validatedData['no_telp'],
            'ktp' => $ktpPath,
            'kk' => $kkPath,
        ]);

        // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
        $riwayat = Riwayat::create([
            'user_id' => auth()->user()->id,
            'surat_id' => $suratKematian->id,
            'vaksin_id' => $kematian->id,
            'jenis_surat' => 'kematian', // Menyimpan informasi jenis surat
            'tanggal_pengajuan' => now(),
            'status' => 'pending',
        ]);

        return redirect('/home')->with('success', 'Pengajuan surat Kematian berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kematian $kematian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kematian $kematian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKematianRequest $request, Kematian $kematian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kematian $kematian)
    {
        //
    }
}
