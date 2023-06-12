<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

use App\Models\Riwayat;
use App\Http\Requests\StoreRiwayatRequest;
use App\Http\Requests\UpdateRiwayatRequest;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       $riwayats = Riwayat::select('riwayats.id as no', 'vaksins.nama_pasien', 'vaksins.no_rekam_medis', 'vaksins.no_telp', 'riwayats.jenis_surat', 'riwayats.tanggal_pengajuan', 'riwayats.status')
        ->join('vaksins', 'riwayats.id', '=', 'vaksins.id')
        ->get();

                // Konversi format tanggal menggunakan Carbon
        foreach ($riwayats as $riwayat) {
            $riwayat->tanggal_pengajuan = Carbon::parse($riwayat->tanggal_pengajuan)->translatedFormat('l, d F Y');
        }

    return view('Surat.RIWAYAT.index', compact('riwayats'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiwayatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Riwayat $riwayat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiwayatRequest $request, Riwayat $riwayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riwayat $riwayat)
    {
        //
    }
}
