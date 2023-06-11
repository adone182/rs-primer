<?php

namespace App\Http\Controllers;

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
        return view('Surat.Lahir.index', [
            'lahirs' => Lahir::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Surat.Lahir.create');
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

            $ktpFileName = $ktpFile->store('berkas-lahir');
            $kkFileName = $kkFile->store('berkas-lahir');
        }

        $lahir = new Lahir();
        $lahir->ktp = $ktpFileName ?? null;
        $lahir->kk = $kkFileName ?? null;
        $lahir->save();

        return redirect('/home/lahir')->with('success', 'Selamat, Pengajuan Surat Keterangan Lahir Anda Berhasil Dikirim');
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
