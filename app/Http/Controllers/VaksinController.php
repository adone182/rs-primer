<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');


use App\Models\Vaksin;
use App\Models\Surat;
use App\Models\Riwayat;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVaksinRequest;
use App\Http\Requests\UpdateVaksinRequest;

class VaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Surat.Vaksin.index', [
        //     'vaksins' => Vaksin::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $suratLainnya = Surat::where('jenis_surat', 'LAINLAIN')->first();
    return view('Surat.LAINNYA.create', compact('suratLainnya'));
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
    $ktpPath = $request->file('ktp')->store('surat_lainnya');
    $kkPath = $request->file('kk')->store('surat_lainnya');

    // Simpan pengajuan surat ke tabel 
    $lainnya = Vaksin::create([
        'user_id' => auth()->user()->id,
        'nama_pasien' => $validatedData['nama_pasien'],
        'no_rekam_medis' => $validatedData['no_rekam_medis'],
        'no_telp' => $validatedData['no_telp'],
        'ktp' => $ktpPath,
        'kk' => $kkPath,
    ]);

    // Dapatkan surat vaksin dari database
    $suratLainnya = Surat::where('jenis_surat', 'LAINLAIN')->first();
    
    if (!$suratLainnya) {
        // Tambahkan penanganan kesalahan jika surat tidak ditemukan
        return redirect()->back()->with('error', 'Surat tidak ditemukan.');
    }

    // Simpan riwayat pengajuan surat ke dalam tabel "riwayats"
    $riwayat = Riwayat::create([
        'user_id' => auth()->user()->id,
        'surat_id' => $suratLainnya->id,
        'vaksin_id' => $lainnya->id,
        'jenis_surat' => 'LAIN-LAIN',
        'tanggal_pengajuan' =>  Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
        'status' => 'pending',
    ]);

    return redirect('/riwayat')->with('success', 'Pengajuan surat berhasil dikirim.');
}






    /**
     * Display the specified resource.
     */
    public function show(Vaksin $vaksin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaksin $vaksin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVaksinRequest $request, Vaksin $vaksin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaksin $vaksin)
    {
        Vaksin::destroy($vaksin->id);
        return redirect('/suratvaksin')->with('success', 'Selamat, Pengajuan Anda Berhasil Di Hapus');
    }
}
