<?php

namespace App\Http\Controllers;

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
        return view('Surat.Rawat.index', [
            'rawats' => RawatJalan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Surat.Rawat.create');
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

            $ktpFileName = $ktpFile->store('berkas-rawat');
            $kkFileName = $kkFile->store('berkas-rawat');
        }

        $rawat = new Rawat();
        $rawat->ktp = $ktpFileName ?? null;
        $rawat->kk = $kkFileName ?? null;
        $rawat->save();

        return redirect('/home/rawatjalan')->with('success', 'Selamat, Pengajuan Surat Rawat Jalan Anda Berhasil Dikirim');
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
