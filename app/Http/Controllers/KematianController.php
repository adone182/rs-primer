<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

use App\Models\Riwayat;
use App\Models\Kematian;
use App\Models\Surat;

use Illuminate\Http\Request;
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
        $suratKematian = Surat::where('jenis_surat', 'KEMATIAN')->first();
        return view('Surat.KEMATIAN.create', compact('suratKematian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pasien' => 'required|string',
            'no_rekam_medis' => 'required|numeric|max:999999999999',
            'no_telp' => 'required|numeric|max:999999999999',
            'ktp' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf|max:1024',
        ]);

        // Simpan file KTP, KK, dan SKCK yang diunggah
        $ktpPath = $request->file('ktp')->store('surat_kematian');
        $kkPath = $request->file('kk')->store('surat_kematian');

        // Simpan pengajuan surat ke tabel
        $kematian = new Kematian();
        $kematian->user_id = auth()->user()->id;
        $kematian->nama_pasien = $validatedData['nama_pasien'];
        $kematian->no_rekam_medis = $validatedData['no_rekam_medis'];
        $kematian->no_telp = $validatedData['no_telp'];
        $kematian->ktp = $ktpPath;
        $kematian->kk = $kkPath;
        $kematian->save();

        // Dapatkan surat dari database
        $suratKematian = Surat::where('jenis_surat', 'KEMATIAN')->first();
        
        if (!$suratKematian) {
            // Tambahkan penanganan kesalahan jika surat tidak ditemukan
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
        $riwayat = Riwayat::create([
            'user_id' => auth()->user()->id,
            'surat_id' => $suratKematian->id,
            'kematian_id' => $kematian->id,
            'jenis_surat' => 'KEMATIAN',
            'tanggal_pengajuan' =>  Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'status' => 'pending',
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan surat kematian berhasil dikirim.');
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
