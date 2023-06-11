<?php

namespace App\Http\Controllers;

use App\Models\Visum;
use App\Http\Requests\StoreVisumRequest;
use App\Http\Requests\UpdateVisumRequest;

class VisumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Surat.Visum.index', [
            'visums' => Visum::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Surat.Visum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisumRequest $request)
    {
        $request->validate([
            'ktp' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf|max:1024',
        ]);

        if ($request->hasFile('ktp') && $request->hasFile('kk')) {
            $ktpFile = $request->file('ktp');
            $kkFile = $request->file('kk');

            $ktpFileName = $ktpFile->store('berkas-visum');
            $kkFileName = $kkFile->store('berkas-visum');
        }

        $visum = new Visum();
        $visum->ktp = $ktpFileName ?? null;
        $visum->kk = $kkFileName ?? null;
        $visum->save();

        return redirect('/home/visum')->with('success', 'Selamat, Pengajuan Surat Visum Anda Berhasil Dikirim');
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
