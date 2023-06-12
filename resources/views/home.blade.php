{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.app')

@section('content')

<div class="container text-center my-5 alert alert-warning" role="alert">
    <span>Selamat datang <b>{{ Auth::user()->name }}</b>, sesuaikan permintaan surat yang anda butuhkan ya :)</span>
   </div>
<div class="container">
    <div class="row g-5 text-center">
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card">
                <img src="{{url('/images/surat-asuransi.webp')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Klaim Asuransi</h5>
                  <a href="/home/asuransi/create" class="btn btn-primary">Ajukan Permintaan</a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card">
                <img src="{{url('/images/surat-covid.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Surat Covid</h5>
                  <a href="/home/covid/craete" class="btn btn-primary">Ajukan Permintaan</a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card">
                <img src="{{url('images/ringkasan-rawat-jalan.webp')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Ringkasan Rawat Jalan</h5>
                  <a href="/home/rawatjalan/create" class="btn btn-primary">Ajukan Permintaan</a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card">
                <img src="{{url('images/ringkasan-rawat-inap.webp')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Resume Medis Rawat Inap</h5>
                  <a href="/home/medis/create" class="btn btn-primary">Ajukan Permintaan</a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card">
                <img src="{{url('images/imunisasi.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Ringkasan Imunisasi</h5>
                  <a href="/home/imunisasi/create" class="btn btn-primary">Ajukan Permintaan</a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card">
                <img src="{{url('images/surat-kematian.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Surat Keterangan Kematian</h5>
                  <a href="/home/kematian/create" class="btn btn-primary">Ajukan Permintaan</a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card">
                <img src="{{url('images/surat-kelahiran.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Surat Keterangan Lahir</h5>
                  <a href="/home/lahir/create" class="btn btn-primary">Ajukan Permintaan</a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card">
                <img src="{{url('images/surat-visum.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Visum Et Repertum</h5>
                  <a href="/home/visum/create" class="btn btn-primary">Ajukan Permintaan</a>
                </div>
              </div>
        </div>
    </div>
</div>
</div>
    
@endsection

@section('footer')
    
@endsection
