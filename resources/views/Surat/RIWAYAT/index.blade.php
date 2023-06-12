<!-- resources/views/riwayat/index.blade.php -->
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center my-5 pb-2 mb-3 border-bottom">
    <h1 class="h2">DAFTAR RIWAYAT PENGAJUAN {{ auth()->user()->id }} </h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-12">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="table-responsive col-lg-12">
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
                    <td>{{ $riwayat->nama_pasien }}</td>
                    <td>{{ $riwayat->no_rekam_medis }}</td>
                    <td>{{ $riwayat->no_telp }}</td>
                    <td>{{ $riwayat->jenis_surat }}</td>
                    <td>{{ $riwayat->tanggal_pengajuan }}</td>
                    <td>{{ $riwayat->status }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>

@endsection
