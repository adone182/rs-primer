<?php

namespace App\Http\Controllers;

use App\Models\Vaksin;
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
        return view('Surat.Vaksin.index', [
            'vaksins' => Vaksin::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Surat.Vaksin.create');
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

            $ktpFileName = $ktpFile->store('berkas-vaksin');
            $kkFileName = $kkFile->store('berkas-vaksin');
        }

        $vaksin = new Vaksin();
        $vaksin->ktp = $ktpFileName ?? null;
        $vaksin->kk = $kkFileName ?? null;
        $vaksin->save();

        return redirect('/home/vaksin')->with('success', 'Selamat, Pengajuan Surat Vaksin Anda Berhasil Dikirim');
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
