@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">DAFTAR PENGAJUAN SURAT VAKSIN</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- table --}}
<div class="table-responsive col-lg-8">
    <a href="/home/vaksin/create" class="btn btn-primary mb-3">BUAT PENGAJUAN VAKSIN</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">KTP(Kartu Tanda Penduduk)</th>
                <th scope="col">KK(Kartu Keluarga)</th>
                {{-- <th scope="col">Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($vaksins as $vaksin)
                <tr>
                    <td>{{ $vaksin->id }}</td>
                    <td>{{ $vaksin->ktp}}</td>
                    <td>{{ $vaksin->kk}}</td>
                    {{-- <td>
                        <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info text-decoration-none"><span
                                data-feather="eye"></span> Show</a>
                        <a href="/dashboard/posts/{{ $post->slug }}/edit"
                            class="badge bg-primary text-decoration-none"><span data-feather="edit"></span> Edit</a>
                        {{-- pake form karena buat bkin requestnya --}}
                        {{-- <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0"
                                onclick="return confirm('Are you sure to delete this Post?')"><span
                                    data-feather="x-circle"></span>
                                Delete</button>
                        </form> --}}
                    {{-- </td> --}}

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection