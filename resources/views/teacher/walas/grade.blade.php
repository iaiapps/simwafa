@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
    @if ($students == null)
        <div class="card p-3 text-center">
            <p class="fs-5">Anda belum ditetapkan sebagai Wali Kelas</p>
            <p>Hubungi Admin</p>
        </div>
    @else
        <div class="card p-3 mb-3">
            <form action="{{ route('student.grade') }}" method="get">
                <div class="row">
                    <div class="input-group">
                        <select name="year_id" id="year" class="form-select">
                            <option selected disabled>-- pilih tahun ajaran --</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}">{{ $year->year . ' - ' . $year->description }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary input-group-button">pilih tahun</button>
                    </div>
                </div>
            </form>
        </div>
        @if ($year_id == null)
            <div class="card p-3">
                <p class="text-center mb-0">Pilih tahun terlebih dahulu</p>
            </div>
        @else
            @php
                $year_name = $years->where('id', $year_id)->first();
            @endphp
            <div class="card rounded p-3">
                <p class="text-center fs-5 mb-1 rounded">Siswa : {{ $teacher->grade->name_grade }}</p>
                <p class="text-center m-0">Data khusus Wali Kelas</p>
                <hr class="mb-4">
                <small class="mb-1 mx-2">*geser tabel jika terpotong</small>

                <div class="table-responsive">
                    <table id="tablee" class="table table-bordered ">
                        <thead class="text-center align-middle">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Kelompok</th>
                                <th scope="col">Jilid</th>
                                @foreach ($komponens->sortBy('komponen_id') as $komponen)
                                    <th> {{ $komponen->name_komp }}</th>
                                @endforeach
                                <th scope="col">Rerata</th>
                                <th scope="col">Action</th>

                            </tr>

                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->cluster->name_cluster ?? 'belum ditentukan' }}</td>
                                    <td>{{ $student->stage->name_stage ?? 'belum ditentukan' }}</td>
                                    @foreach ($komponens as $komponen)
                                        <td class="text-center">
                                            {{ $student->evaluation->where('komponen_id', $komponen->id)->where('year_id', $year_id)->first()->nilai ?? '-' }}
                                        </td>
                                    @endforeach
                                    <td class="text-center">
                                        {{ $student->evaluation->where('year_id', $year_id)->avg('nilai') ?? 'nilai belum ada' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('student.evaluation.show', $student->id) }}"
                                            class="btn btn-warning btn-sm">detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Siswa belum ada</td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endif
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script>
        var sites = {!! json_encode($teacher->grade->name_grade, JSON_HEX_TAG) !!};
        $(document).ready(function() {
            $('#tablee').DataTable({
                "pageLength": 50,
                "buttons": [{
                    extend: 'excelHtml5',
                    text: '<i class="bi bi-file-earmark-excel"></i> Download data excel',
                    titleAttr: 'Excel',
                    className: 'btn btn-primary btn-sm',
                    title: 'Data nilai Wafa ' + sites
                }, ],
                "layout": {
                    topStart: 'buttons'
                }
            });
        });
    </script>
@endpush
