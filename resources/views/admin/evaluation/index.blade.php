@extends('layouts.app')

@section('title', 'Data Nilai Siswa')

@php
    $count = count($data_komponen);
@endphp

@section('content')
    <div class="card p-3 mb-3">
        <p>filter data berdasarkan kelas </p>
        <form action="{{ route('evaluation.index') }}" method="get">
            <div class="row">
                <div class="input-group mb-3">
                    <select name="grade_id" id="grade" class="form-select">
                        <option selected disabled>-- pilih kelas --</option>
                        {{-- <option value="0">semua kelas</option> --}}
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name_grade }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">filter data</button>
                </div>
            </div>
        </form>
    </div>

    @if ($students == null)
        <div class="card p-3">
            <p class="fs-5 text-center m-0">kelas belum dipilih</p>
        </div>
    @else
        <div class="card p-3">
            {{-- <div class="d-block">
                <a href="{{ route('evaluation.create') }}" class="btn btn-primary mb-3">Tambah Nilai</a>
            </div> --}}

            <p class="text-center mb-0 fs-5">{{ $grade_name->name_grade }}</p>
            <hr class="mb-3">
            <div class="table-responsive">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr class="align-middle text-center">
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Kelompok</th>
                            @foreach ($komponens->sortBy('komponen_id') as $komponen)
                                <th> {{ $komponen->name_komp }}</th>
                            @endforeach
                            <th> Rerata Nilai </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }} </td>
                                <td>{{ $student->cluster->name_cluster }}</td>

                                @foreach ($komponens as $komponen)
                                    <td class="mb-0">
                                        {{ $student->evaluation->where('komponen_id', $komponen->id)->first()?->nilai }}
                                    </td>
                                @endforeach

                                <td class="text-center">
                                    {{ $student->evaluation->avg('nilai') ?? 'nilai belum ada' }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                        action="{{ route('evaluation.destroy', ['del' => $student->id, 'grade_id' => request()->get('grade_id')]) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash3"></i> del
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $count + 5 }}" class="text-center">data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @endif



@endsection
@include('layouts.partials.scripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').arrowTable({
                enabledKeys: ['left', 'right', 'up', 'down'],
                listenTarget: 'input.form-control'
            });

            $('#table').DataTable({
                "pageLength": 50,
            });

            $('#grade').select2({
                theme: 'bootstrap-5'
            });

            // dates('option');
            // months('option');
            // //You can change the startYear(1990) and endYear(2017)
            // years('option', 2010, 2025);
        });
    </script>
@endpush
