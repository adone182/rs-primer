@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-0 pb-0 mb-5 border-bottom mt-5">
        <h1 class="h2">FORM PENGAJUAN SURAT ASURANSI</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8" style="background: rgb(243, 242, 242);padding:50px 20px 20px;border-radius:10px">
            
            <form action="/home/asuransi" method="POST" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="surat_kuasa" class="form-label @error('surat_kuasa') is-invalid @enderror">Surat Kuasa</label>
                    <input class="form-control" type="file" id="surat_kuasa" name="surat_kuasa" required >
                    @error('surat_kuasa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ktp" class="form-label @error('ktp') is-invalid @enderror">Kartu Identitas(KTP)</label>
                    <input class="form-control" type="file" id="ktp" name="ktp" required >
                    @error('ktp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="kk" class="form-label @error('kk') is-invalid @enderror">Kartu Keluarga(KK)</label>
                    <input class="form-control" type="file" id="kk" name="kk" required>
                    @error('kk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">Kirim Pengajuan</button>
                </div>
            </form>
        </div>
    </div>
@endsection