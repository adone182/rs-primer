<?php

namespace App\Http\Controllers;

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
        return view('Surat.Asuransi.index', [
            'asuransis' => Asuransi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Surat.Asuransi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'surat_kuasa' => 'required|file|mimes:pdf|max:1024',
            'ktp' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf|max:1024',
        ]);

        if ($request->hasFile('surat_kuasa') && $request->hasFile('ktp') && $request->hasFile('kk')) {
            $kuasaFile = $request->file('surat_kuasa');
            $ktpFile = $request->file('ktp');
            $kkFile = $request->file('kk');

            $kuasaFileName = $kuasaFile->store('berkas-asurance');
            $ktpFileName = $ktpFile->store('berkas-asurance');
            $kkFileName = $kkFile->store('berkas-asurance');
        }

        $asuransi = new Asuransi();
        $asuransi->surat_kuasa = $kuasaFileName ?? null;
        $asuransi->ktp = $ktpFileName ?? null;
        $asuransi->kk = $kkFileName ?? null;
        $asuransi->save();

        return redirect('/home/asuransi')->with('success', 'Selamat, Pengajuan Surat Asuransi Anda Berhasil Dikirim');
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
