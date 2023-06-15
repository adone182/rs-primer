<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

use App\Models\Surat;
use App\Models\Riwayat;
use App\Models\RawatJalan;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRawatJalanRequest;
use App\Http\Requests\UpdateRawatJalanRequest;

class RawatJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Surat.Rawat.index', [
        //     'rawats' => RawatJalan::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $suratRawat = Surat::where('jenis_surat', 'RAWATJALAN')->first();
         return view('Surat.RAWAT.create', compact('suratRawat'));
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
        $ktpPath = $request->file('ktp')->store('surat_rawatjalan');
        $kkPath = $request->file('kk')->store('surat_rawatjalan');

        // Simpan pengajuan surat ke tabel
        $rawat = new RawatJalan();
        $rawat->user_id = auth()->user()->id;
        $rawat->nama_pasien = $validatedData['nama_pasien'];
        $rawat->no_rekam_medis = $validatedData['no_rekam_medis'];
        $rawat->no_telp = $validatedData['no_telp'];
        $rawat->ktp = $ktpPath;
        $rawat->kk = $kkPath;
        $rawat->save();

        // Dapatkan surat dari database
        $suratRawat = Surat::where('jenis_surat', 'RAWATJALAN')->first();
        
        if (!$suratRawat) {
            // Tambahkan penanganan kesalahan jika surat tidak ditemukan
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
        $riwayat = Riwayat::create([
            'user_id' => auth()->user()->id,
            'surat_id' => $suratRawat->id,
            'rawat_jalan_id' => $rawat->id,
            'jenis_surat' => 'RAWATJALAN',
            'tanggal_pengajuan' =>  Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'status' => 'pending',
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan surat Rawat Jalan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RawatJalan $rawatJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RawatJalan $rawatJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRawatJalanRequest $request, RawatJalan $rawatJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RawatJalan $rawatJalan)
    {
        //
    }
}
