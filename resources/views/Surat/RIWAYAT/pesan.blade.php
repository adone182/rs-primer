<!-- pesan.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Pesan') }}</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($pesan as $pesan)
                                <li class="list-group-item">{{ $pesan }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
