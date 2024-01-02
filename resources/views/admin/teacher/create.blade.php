@extends('layouts.app')

@section('title', 'Tentukan Data Guru')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('teacher.store') }}">
                @csrf

                @if ($teachers->isEmpty())
                    <div>
                        <p class="text-center fs-5">data kelas dan kelompok sudah ditentukan</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Kelompok</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <input name="teacher_id[{{ $teacher->id }}]" value="{{ $teacher->id }}" hidden>
                                        <td>{{ $teacher->id }}</td>
                                        <td>{{ $teacher->name }}</td>
                                        <td>
                                            @if ($teacher->grade_id == null)
                                                <select class="form-select" name="grade_id[{{ $teacher->id }}]">
                                                    <option disabled selected>---pilih kelas---</option>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->name_grade }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select class="form-select" name="grade_id[{{ $teacher->id }}]">
                                                    <option value="{{ $teacher->grade->id }}" selected>
                                                        {{ $teacher->grade->name_grade }}</option>
                                                </select>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($teacher->cluster_id == null)
                                                <select class="form-select" name="cluster_id[{{ $teacher->id }}]">
                                                    <option disabled selected>---pilih kelompok---</option>
                                                    @foreach ($clusters as $cluster)
                                                        <option value="{{ $cluster->id }}">{{ $cluster->name_cluster }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select class="form-select" name="cluster_id[{{ $teacher->id }}]">
                                                    <option value="{{ $teacher->cluster->id }}" selected>
                                                        {{ $teacher->cluster->name_cluster }}</option>
                                                </select>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">
                                {{ __('Tambah Data Guru') }}
                            </button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
