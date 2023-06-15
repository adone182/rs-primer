<!-- resources/views/riwayat/index.blade.php -->
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center flex-wrap flex-md-nowrap np run devalign-items-center my-5 pb-2 mb-3 border-bottom">
    <h1 class="h2">DAFTAR RIWAYAT PENGAJUAN ATAS PASIEN "{{ auth()->user()->name }}" </h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-12">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="table-responsive col-lg-12">
    <a href="/home" class="btn btn-outline-primary mb-3">Kembali ke Daftar Pengajuan</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <tr>
                <th>ID</th>
                <th>Nama Pasien</th>
                <th>No. Rekam Medis</th>
                <th>No. Handphone</th>
                <th>Jenis Surat</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                 {{-- <th scope="col">Action</th> --}}
            </tr>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayats as $riwayat)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                     @if ($riwayat->vaksin)
                       <td>{{ $riwayat->vaksin->nama_pasien }}</td>
                       <td>{{ $riwayat->vaksin->no_rekam_medis }}</td>
                       <td>{{ $riwayat->vaksin->no_telp }}</td>

                    @elseif ($riwayat->rawat_jalan)
                       <td>{{ $riwayat->rawat_jalan->nama_pasien }}</td>
                       <td>{{ $riwayat->rawat_jalan->no_rekam_medis }}</td>
                       <td>{{ $riwayat->rawat_jalan->no_telp }}</td>

                    @elseif ($riwayat->imunisasi)
                       <td>{{ $riwayat->imunisasi->nama_pasien }}</td>
                       <td>{{ $riwayat->imunisasi->no_rekam_medis }}</td>
                       <td>{{ $riwayat->imunisasi->no_telp }}</td>

                    @elseif ($riwayat->asuransi)
                       <td>{{ $riwayat->asuransi->nama_pasien }}</td>
                       <td>{{ $riwayat->asuransi->no_rekam_medis }}</td>
                       <td>{{ $riwayat->asuransi->no_telp }}</td>

                    @elseif ($riwayat->visum)
                       <td>{{ $riwayat->visum->nama_pasien }}</td>
                       <td>{{ $riwayat->visum->no_rekam_medis }}</td>
                       <td>{{ $riwayat->visum->no_telp }}</td>

                    @elseif ($riwayat->lahir)
                       <td>{{ $riwayat->lahir->nama_pasien }}</td>
                       <td>{{ $riwayat->lahir->no_rekam_medis }}</td>
                       <td>{{ $riwayat->lahir->no_telp }}</td>

                    @elseif ($riwayat->kematian)
                       <td>{{ $riwayat->kematian->nama_pasien }}</td>
                       <td>{{ $riwayat->kematian->no_rekam_medis }}</td>
                       <td>{{ $riwayat->kematian->no_telp }}</td>

                    @elseif ($riwayat->medis)
                       <td>{{ $riwayat->medis->nama_pasien }}</td>
                       <td>{{ $riwayat->medis->no_rekam_medis }}</td>
                       <td>{{ $riwayat->medis->no_telp }}</td>

                    @endif
                    <td>{{ $riwayat->jenis_surat }}</td>
                    <td>{{ \Carbon\Carbon::parse($riwayat->tanggal_pengajuan)->isoFormat('dddd, D MMMM Y', 'id') }}</td>
                    <td>{{ $riwayat->status }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>

@endsection
