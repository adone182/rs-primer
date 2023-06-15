<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

use App\Models\Imunisasi;
use App\Models\Surat;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImunisasiRequest;
use App\Http\Requests\UpdateImunisasiRequest;

class ImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Surat.Imunisasi.index', [
        //     'imunisasis' => Imunisasi::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $suratImunisasi = Surat::where('jenis_surat', 'IMUNISASI')->first();
         return view('Surat.IMUNISASI.create', compact('suratImunisasi'));
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
        $ktpPath = $request->file('ktp')->store('surat_imunisasi');
        $kkPath = $request->file('kk')->store('surat_imunisasi');

        // Simpan pengajuan surat ke tabel
        $imunisasi = new Imunisasi();
        $imunisasi->user_id = auth()->user()->id;
        $imunisasi->nama_pasien = $validatedData['nama_pasien'];
        $imunisasi->no_rekam_medis = $validatedData['no_rekam_medis'];
        $imunisasi->no_telp = $validatedData['no_telp'];
        $imunisasi->ktp = $ktpPath;
        $imunisasi->kk = $kkPath;
        $imunisasi->save();

        // Dapatkan surat dari database
        $suratImunisasi = Surat::where('jenis_surat', 'IMUNISASI')->first();
        
        if (!$suratImunisasi) {
            // Tambahkan penanganan kesalahan jika surat tidak ditemukan
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
        $riwayat = Riwayat::create([
            'user_id' => auth()->user()->id,
            'surat_id' => $suratImunisasi->id,
            'imunisasi_id' => $imunisasi->id,
            'jenis_surat' => 'IMUNISASI',
            'tanggal_pengajuan' =>  Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'status' => 'pending',
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan surat imunisasi berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Imunisasi $imunisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imunisasi $imunisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImunisasiRequest $request, Imunisasi $imunisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imunisasi $imunisasi)
    {
        //
    }
}
