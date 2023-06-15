<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

use App\Models\Surat;
use App\Models\Riwayat;
use App\Models\Lahir;
use Illuminate\Http\Request;

use App\Http\Requests\StoreLahirRequest;
use App\Http\Requests\UpdateLahirRequest;

class LahirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Surat.Lahir.index', [
        //     'lahirs' => Lahir::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $suratLahir = Surat::where('jenis_surat', 'KELAHIRAN')->first();
         return view('Surat.LAHIR.create', compact('suratLahir'));
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
        $ktpPath = $request->file('ktp')->store('surat_lahir');
        $kkPath = $request->file('kk')->store('surat_lahir');

        // Simpan pengajuan surat ke tabel
        $lahir = new Lahir();
        $lahir->user_id = auth()->user()->id;
        $lahir->nama_pasien = $validatedData['nama_pasien'];
        $lahir->no_rekam_medis = $validatedData['no_rekam_medis'];
        $lahir->no_telp = $validatedData['no_telp'];
        $lahir->ktp = $ktpPath;
        $lahir->kk = $kkPath;
        $lahir->save();

        // Dapatkan surat dari database
        $suratLahir = Surat::where('jenis_surat', 'KELAHIRAN')->first();
        
        if (!$suratLahir) {
            // Tambahkan penanganan kesalahan jika surat tidak ditemukan
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
        $riwayat = Riwayat::create([
            'user_id' => auth()->user()->id,
            'surat_id' => $suratLahir->id,
            'lahir_id' => $lahir->id,
            'jenis_surat' => 'KELAHIRAN',
            'tanggal_pengajuan' =>  Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'status' => 'pending',
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan surat kelarhiran berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lahir $lahir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lahir $lahir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLahirRequest $request, Lahir $lahir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lahir $lahir)
    {
        //
    }
}
