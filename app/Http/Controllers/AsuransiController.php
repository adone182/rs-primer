<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

use App\Models\Surat;
use App\Models\Riwayat;
use App\Models\Asuransi;
use Illuminate\Http\Request;

use App\Http\Requests\StoreAsuransiRequest;
use App\Http\Requests\UpdateAsuransiRequest;

class AsuransiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Surat.Asuransi.index', [
        //     'asuransis' => Asuransi::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $suratAsuransi = Surat::where('jenis_surat', 'ASURANSI')->first();
         return view('Surat.ASURANSI.create', compact('suratAsuransi'));
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
            'surat_kuasa' => 'required|file|mimes:pdf|max:1024',
            'ktp' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf|max:1024',
        ]);

        // Simpan file KTP, KK, dan SKCK yang diunggah
        $kuasaPath = $request->file('surat_kuasa')->store('surat_asuransi');
        $ktpPath = $request->file('ktp')->store('surat_asuransi');
        $kkPath = $request->file('kk')->store('surat_asuransi');

        // Simpan pengajuan surat ke tabel
        $asuransi = new Asuransi();
        $asuransi->user_id = auth()->user()->id;
        $asuransi->nama_pasien = $validatedData['nama_pasien'];
        $asuransi->no_rekam_medis = $validatedData['no_rekam_medis'];
        $asuransi->no_telp = $validatedData['no_telp'];
        $asuransi->surat_kuasa = $kuasaPath;
        $asuransi->ktp = $ktpPath;
        $asuransi->kk = $kkPath;
        $asuransi->save();

        // Dapatkan surat dari database
        $suratAsuransi = Surat::where('jenis_surat', 'ASURANSI')->first();
        
        if (!$suratAsuransi) {
            // Tambahkan penanganan kesalahan jika surat tidak ditemukan
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
        $riwayat = Riwayat::create([
            'user_id' => auth()->user()->id,
            'surat_id' => $suratAsuransi->id,
            'asuransi_id' => $asuransi->id,
            'jenis_surat' => 'ASURANSI',
            'tanggal_pengajuan' =>  Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'status' => 'pending',
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan surat asuransi berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asuransi $asuransi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asuransi $asuransi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsuransiRequest $request, Asuransi $asuransi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asuransi $asuransi)
    {
        //
    }
}
