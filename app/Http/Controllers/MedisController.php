<?php

namespace App\Http\Controllers;

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
        return view('Surat.Medis.index', [
            'medisis' => Medis::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Surat.Medis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedisRequest $request)
    {
        $request->validate([
            'ktp' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf|max:1024',
        ]);

        if ($request->hasFile('ktp') && $request->hasFile('kk')) {
            $ktpFile = $request->file('ktp');
            $kkFile = $request->file('kk');

            $ktpFileName = $ktpFile->store('berkas-medis');
            $kkFileName = $kkFile->store('berkas-medis');
        }

        $medis = new Medis();
        $medis->ktp = $ktpFileName ?? null;
        $medis->kk = $kkFileName ?? null;
        $medis->save();

        return redirect('/home/medis')->with('success', 'Selamat, Pengajuan Surat Resume Medis Anda Berhasil Dikirim');
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
