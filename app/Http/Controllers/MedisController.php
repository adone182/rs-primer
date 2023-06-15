<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

use App\Models\Surat;
use App\Models\Riwayat;
use App\Models\Medis;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMedisRequest;
use App\Http\Requests\UpdateMedisRequest;

class MedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Surat.Medis.index', [
        //     'medisis' => Medis::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $suratMedis = Surat::where('jenis_surat', 'RESUMEMEDIS')->first();
         return view('Surat.MEDIS.create', compact('suratMedis'));
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
        $ktpPath = $request->file('ktp')->store('surat_medis');
        $kkPath = $request->file('kk')->store('surat_medis');

        // Simpan pengajuan surat ke tabel
        $medis = new Medis();
        $medis->user_id = auth()->user()->id;
        $medis->nama_pasien = $validatedData['nama_pasien'];
        $medis->no_rekam_medis = $validatedData['no_rekam_medis'];
        $medis->no_telp = $validatedData['no_telp'];
        $medis->ktp = $ktpPath;
        $medis->kk = $kkPath;
        $medis->save();

        // Dapatkan surat dari database
        $suratMedis = Surat::where('jenis_surat', 'RESUMEMEDIS')->first();
        
        if (!$suratMedis) {
            // Tambahkan penanganan kesalahan jika surat tidak ditemukan
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
        $riwayat = Riwayat::create([
            'user_id' => auth()->user()->id,
            'surat_id' => $suratMedis->id,
            'medis_id' => $medis->id,
            'jenis_surat' => 'RESUMEMEDIS',
            'tanggal_pengajuan' =>  Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'status' => 'pending',
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan surat resume medis berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medis $medis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medis $medis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedisRequest $request, Medis $medis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medis $medis)
    {
        //
    }
}
