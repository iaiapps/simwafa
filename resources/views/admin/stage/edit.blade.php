@extends('layouts.app')

@section('title', 'Edit Jilid')

@section('content')
    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('stage.update', $stage->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name_stage" class="form-label">Nama Jilid</label>
                    <input id="name_stage" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name_stage" value="{{ old('name', $stage->name_stage) }}" required autocomplete="name_stage"
                        autofocus>
                </div>
                <button type="submit" class="btn btn-success"> simpan data </button>
            </form>
        </div>
    </div>
@endsection
