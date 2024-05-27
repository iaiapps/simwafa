@extends('layouts.app')

@section('title', 'Data Siswa')

@php
    $count = count($data_komponen);
@endphp

@section('content')
    @if ($students == null)
        <div class="card p-3 text-center">
            <p class="fs-5">Anda belum ditetapkan sebagai Wali Kelas</p>
            <p>Hubungi Admin</p>
        </div>
    @else
        <div class="card rounded p-3">
            <p class="text-center fs-5 mb-1 rounded">Siswa : {{ $teacher->grade->name_grade }}</p>
            <p class="text-center m-0">Data khusus Wali Kelas</p>
            <hr class="mb-4">
            <small class="mb-2">*geser tabel jika terpotong</small>

            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead class="text-center align-middle">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Kelompok</th>
                            <th scope="col">Jilid</th>
                            <th class="p-0">
                                <table class="table table-bordered m-0">
                                    <th colspan={{ $count }} class="text-center">Nilai</th>
                                    <tr class="align-middle">
                                        @foreach ($data_komponen->sortBy('komponen_id') as $data)
                                            <th style="width:25%" class="border-end border-bottom-0">
                                                {{ $data->komponen->name_komp }}</th>
                                        @endforeach
                                    </tr>
                                </table>
                            </th>
                            <th scope="col">Rerata</th>
                            {{-- <th scope="col">Action</th> --}}

                        </tr>
                        <tr></tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                {{-- <td>{{ $student->grade->name_grade ?? 'belum ditentukan' }}</td> --}}
                                <td>{{ $student->cluster->name_cluster ?? 'belum ditentukan' }}</td>
                                <td>{{ $student->stage->name_stage ?? 'belum ditentukan' }}</td>
                                <td class="m-0 p-0">
                                    <table class="table m-0 p-0">
                                        <tr>
                                            @foreach ($student->evaluation->sortBy('komponen_id') as $nilai => $i)
                                                @if (count($student->evaluation) < count($data_komponen))
                                                    <td style="width:25%" class="border-start border-end border-bottom-0">
                                                        {{ $i->nilai }}</td>
                                                    @if ($loop->last)
                                                        <td style="width:25%"
                                                            class="border-start border-end border-bottom-0">-</td>
                                                    @endif
                                                @else
                                                    <td style="width:25%" class=" border-start border-end border-bottom-0">
                                                        {{ $i->nilai }} </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </table>
                                </td>

                                <td colspan="{{ $count + 1 }}" class="text-center">
                                    {{ $student->evaluation->avg('nilai') ?? 'nilai belum ada' }}</td>
                                {{-- <td>
                                    <a href="{{ route('student.evaluation.show', $student->id) }}"
                                        class="btn btn-warning btn-sm">detail</a>
                                </td> --}}
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
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "pageLength": 50
            });
        });
    </script>
@endpush
