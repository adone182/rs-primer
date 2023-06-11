<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Http\Requests\StoreImunisasiRequest;
use App\Http\Requests\UpdateImunisasiRequest;

class ImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Surat.Imunisasi.index', [
            'imunisasi' => Imunisasi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Surat.Imunisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ktp' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf|max:1024',
        ]);

        if ($request->hasFile('ktp') && $request->hasFile('kk')) {
            $ktpFile = $request->file('ktp');
            $kkFile = $request->file('kk');

            $ktpFileName = $ktpFile->store('berkas-imunisasi');
            $kkFileName = $kkFile->store('berkas-imunisasi');
        }

        $imunisasi = new Imunisasi();
        $imunisasi->ktp = $ktpFileName ?? null;
        $imunisasi->kk = $kkFileName ?? null;
        $imunisasi->save();

        return redirect('/home/imunisasi')->with('success', 'Selamat, Pengajuan Surat Imunisasi Anda Berhasil Dikirim');
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
