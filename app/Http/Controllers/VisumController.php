<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

use App\Models\Surat;
use App\Models\Riwayat;
use App\Models\Visum;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVisumRequest;
use App\Http\Requests\UpdateVisumRequest;

class VisumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Surat.Visum.index', [
        //     'visums' => Visum::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  $suratVisum = Surat::where('jenis_surat', 'VISUM')->first();
         return view('Surat.VISUM.create');
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
            'skck' => 'required|file|mimes:pdf|max:1024',
        ]);

        // Simpan file KTP, KK, dan SKCK yang diunggah
        $ktpPath = $request->file('ktp')->store('surat_visum');
        $kkPath = $request->file('kk')->store('surat_visum');
        $skckPath = $request->file('skck')->store('surat_visum');

        // Simpan pengajuan surat ke tabel
        $visum = new Visum();
        $visum->user_id = auth()->user()->id;
        $visum->nama_pasien = $validatedData['nama_pasien'];
        $visum->no_rekam_medis = $validatedData['no_rekam_medis'];
        $visum->no_telp = $validatedData['no_telp'];
        $visum->ktp = $ktpPath;
        $visum->kk = $kkPath;
        $visum->skck = $skckPath;
        $visum->save();

        // Dapatkan surat dari database
        $suratVisum = Surat::where('jenis_surat', 'VISUM')->first();
        
        if (!$suratVisum) {
            // Tambahkan penanganan kesalahan jika surat tidak ditemukan
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
        $riwayat = Riwayat::create([
            'user_id' => auth()->user()->id,
            'surat_id' => $suratVisum->id,
            'visum_id' => $visum->id,
            'jenis_surat' => 'VISUM',
            'tanggal_pengajuan' =>  Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'status' => 'pending',
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan surat visum berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visum $visum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visum $visum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisumRequest $request, Visum $visum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visum $visum)
    {
        //
    }
}
