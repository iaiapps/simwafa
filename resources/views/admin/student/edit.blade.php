@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('student.update', $student->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Nama') }}</label>
                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $student->name) }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-2 col-form-label" for="grade">Kelas</label>
                    <div class="col-md-10">
                        @if ($student->grade)
                            <input type="text" class="form-control" disabled value="{{ $student->grade->name_grade }}">
                        @else
                            <select class="form-select" id="grade" name="grade_id">
                                <option disabled>---pilih kelas---</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name_grade }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Nama Kelompok (Id)</label>
                    <div class="col-md-10">
                        {{-- @if ($student->cluster)
                            <input type="text" class="form-control" disabled
                                value="{{ $student->cluster->name_cluster }}">
                        @else --}}
                        <select class="form-select" id="role" name="cluster_id">
                            <option disabled selected>---pilih kelompok---</option>
                            @foreach ($clusters as $cluster)
                                <option value="{{ $cluster->id }}">{{ $cluster->name_cluster }}</option>
                            @endforeach
                        </select>
                        {{-- @endif --}}
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">Nama Jilid (Id)</label>
                    <div class="col-md-10">
                        {{-- @if ($student->stage)
                            <input type="text" class="form-control" disabled value="{{ $student->stage->name_stage }}">
                        @else --}}
                        <select class="form-select" id="role" name="stage_id">
                            <option disabled selected>---pilih jilid---</option>
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->name_stage }}</option>
                            @endforeach
                        </select>
                        {{-- @endif --}}
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">
                            simpan data siswa
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
