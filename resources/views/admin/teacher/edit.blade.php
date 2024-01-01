@extends('layouts.app')

@section('title', 'Edit Data Guru')

@section('content')

    <div class="card">
        {{-- <div class="card-header bg-success">{{ __('Register') }}</div> --}}
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('teacher.update', $teacher->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Nama') }}</label>
                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control bg-light @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $teacher->name) }}" required readonly>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">User Name (Id)</label>
                    <div class="col-md-10">
                        <select class="form-select" id="role" name="user_id">
                            <option disabled selected>---pilih user---</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Kelas (Id)</label>
                    <div class="col-md-10">
                        <select class="form-select" id="role" name="grade_id">
                            <option disabled selected>---pilih kelas---</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name_grade }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Kelompok (Id)</label>
                    <div class="col-md-10">
                        <select class="form-select" id="role" name="cluster_id">
                            <option disabled selected>---pilih kelompok---</option>
                            @foreach ($clusters as $cluster)
                                <option value="{{ $cluster->id }}">{{ $cluster->name_cluster }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">
                            simpan data guru
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
