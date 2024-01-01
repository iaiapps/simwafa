@extends('layouts.app')

@section('title', 'Buat Kelompok Baru')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('cluster.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Nama') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">
                            {{ __('Tambah Kelompok Baru') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
