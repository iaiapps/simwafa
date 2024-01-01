@extends('layouts.app')

@section('title', 'Buat Data Siswa')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('student.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Nama Siswa</label>
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

                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Nama Kelas (Id)</label>
                    <div class="col-md-10">
                        <select class="form-select" id="role" name="grade_id">
                            <option disabled selected>---pilih kelas---</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Nama Kelompok (Id)</label>
                    <div class="col-md-10">
                        <select class="form-select" id="role" name="cluster_id">
                            <option disabled selected>---pilih kelompok---</option>
                            @foreach ($clusters as $cluster)
                                <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Nama Jilid (Id)</label>
                    <div class="col-md-10">
                        <select class="form-select" id="role" name="cluster_id">
                            <option disabled selected>---pilih jilid---</option>
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">
                            Tambah Siswa
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
