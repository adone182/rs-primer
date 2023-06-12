@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-0 pb-0 mb-5 border-bottom mt-5">
        <h1 class="h2">FORM PENGAJUAN SURAT KETERANGAN KELAHIRAN</h1>
    </div>

    {{-- form create posts --}}
    <div class="row justify-content-center">
        <div class="col-lg-8" style="background: rgb(243, 242, 242);padding:50px 20px 20px;border-radius:10px">
            
            <form action="/home/lahir" method="POST" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_pasien" class="form-label @error('nama_pasien') is-invalid @enderror">Nama Pasien</label>
                    <small class="d-block fst-italic text-danger">Note : Pastikan nama sesuai dengan kartu identitas</small>
                    <input class="form-control" type="string" id="nama_pasien" name="nama_pasien" Placeholder="Masukan Nama Pasien" required >
                    @error('nama_pasien')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_rekam_medis" class="form-label @error('no_rekam_medis') is-invalid @enderror">No Rekam Medis</label>
                    <small class="d-block fst-italic text-danger">Note : Harap masukan nomor rekam medis yang valid</small>
                    <input class="form-control" type="number" id="no_rekam_medis" name="no_rekam_medis" Placeholder="Masukan No Rekam Medis" required oninput="limitInput(this, 12)">
                    @error('no_rekam_medis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">No Handphone</label>
                    <small class="d-block fst-italic text-danger">Note : Masukan no handphone yang aktif dan bisa dihubungi</small>
                    <input class="form-control" type="number" id="no_telp" name="no_telp" Placeholder="08** - **** - ****" required oninput="limitInput(this, 12)">
                    @error('no_telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ktp" class="form-label @error('ktp') is-invalid @enderror">Kartu Identitas(KTP)</label>
                    <small class="d-block fst-italic text-danger">Note : Format file harus pdf dan maksimal 1MB</small>
                    <input class="form-control" type="file" id="ktp" name="ktp" required >
                    @error('ktp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="kk" class="form-label @error('kk') is-invalid @enderror">Kartu Keluarga(KK)</label>
                    <small class="d-block fst-italic text-danger">Note : Format file harus pdf dan maksimal 1MB</small>
                    <input class="form-control" type="file" id="kk" name="kk" required>
                    @error('kk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-3">
                <button type="submit" class="btn btn-primary btn-block">Kirim Pengajuan</button>
                <a href="/home" class="btn btn-outline-primary btn-block">Batalkan Pengajuan</a>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function limitInput(element, maxLength) {
        if (element.value.length > maxLength) {
            element.value = element.value.slice(0, maxLength);
        }
    }
</script>