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

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
    <h1>PILIHAN SURAT PENGAJUAN</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-4 my-3 img-hover">
            <a href="/home/vaksin/create">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x500?/vaksin" class="img-fluid"
                        alt="">
                    <div class="card-img-overlay p-0 d-flex align-items-center">
                        <h5 class="card-title text-center flex-fill p-4 fs-4"
                            style="background-color: rgba(0,0,0, 0.6)">
                            SURAT VAKSIN
                        </h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 my-3 img-hover">
            <a href="/home/asuransi/create">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x500?/a" nsuranceclass="img-fluid"
                        alt="">
                    <div class="card-img-overlay p-0 d-flex align-items-center">
                        <h5 class="card-title text-center flex-fill p-4 fs-4"
                            style="background-color: rgba(0,0,0, 0.6)">
                            SURAT ASURANSI
                        </h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 my-3 img-hover">
            <a href="/home/lahir/create">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x500?/born" class="img-fluid"
                        alt="">
                    <div class="card-img-overlay p-0 d-flex align-items-center">
                        <h5 class="card-title text-center flex-fill p-4 fs-4"
                            style="background-color: rgba(0,0,0, 0.6)">
                            SURAT KETERANGAN KELAHIRAN
                        </h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 my-3 img-hover">
            <a href="/home/rawatjalan/create">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x500?/vaksin" class="img-fluid"
                        alt="">
                    <div class="card-img-overlay p-0 d-flex align-items-center">
                        <h5 class="card-title text-center flex-fill p-4 fs-4"
                            style="background-color: rgba(0,0,0, 0.6)">
                            RINGKASAN RAWAT JALAN
                        </h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 my-3 img-hover">
            <a href="/home/imunisasi/create">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x500?/vaksin" class="img-fluid"
                        alt="">
                    <div class="card-img-overlay p-0 d-flex align-items-center">
                        <h5 class="card-title text-center flex-fill p-4 fs-4"
                            style="background-color: rgba(0,0,0, 0.6)">
                            RINGKASAN IMUNISASI
                        </h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 my-3 img-hover">
            <a href="/home/medis/create">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x500?/medis" class="img-fluid"
                        alt="">
                    <div class="card-img-overlay p-0 d-flex align-items-center">
                        <h5 class="card-title text-center flex-fill p-4 fs-4"
                            style="background-color: rgba(0,0,0, 0.6)">
                            RESUME MEDIS
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <center>
        <div class="col-lg-4 my-3 img-hover">
            <a href="/home/visum/create">
                <div class="card bg-dark text-white">
                    <img src="https://source.unsplash.com/500x500?/visum" class="img-fluid"
                        alt="">
                    <div class="card-img-overlay p-0 d-flex align-items-center">
                        <h5 class="card-title text-center flex-fill p-4 fs-4"
                            style="background-color: rgba(0,0,0, 0.6)">
                            SURAT VISUM
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        </center>

    </div>
</div>
    
@endsection
