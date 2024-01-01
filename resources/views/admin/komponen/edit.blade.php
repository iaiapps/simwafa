@extends('layouts.app')

@section('title', 'Edit Komponen Nilai')

@section('content')
    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('komponen.update', $komponen->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Komponen</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', $komponen->name) }}" required autocomplete="name" autofocus>
                </div>
                <button type="submit" class="btn btn-success"> simpan data </button>
            </form>
        </div>
    </div>
@endsection
