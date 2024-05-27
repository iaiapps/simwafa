@extends('layouts.app')

@section('title', 'Data Nilai Siswa')

@php
    $count = count($data_komponen);
@endphp

@section('content')
    @if ($students == null)
        <div class="card p-3 text-center">
            <p class="fs-5">Anda belum belum memiliki anggota kelompok</p>
            <p>Hubungi Admin</p>
        </div>
    @else
        <div class="card p-3">
            <p class="text-center fs-5 mb-0 rounded">Data nilai siswa : {{ $teacher->cluster->name_cluster }}</p>
            <hr class="mb-4">
            <div class="table-responsive">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Siswa</th>
                            <th class="text-center">Kelas</th>
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
                            <th class="text-center"> Rerata Nilai </th>
                            <th class="text-center"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->grade->name_grade ?? 'belum ditentukan' }}</td>
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
                                <td>{{ $student->evaluation->avg('nilai') ?? 'nilai belum ada' }}</td>
                                <td>
                                    <a href="{{ route('student.evaluation.show', $student->id) }}"
                                        class="btn btn-warning btn-sm">detail</a>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="{{ $count + 5 }}" class="text-center">data nilai tidak
                                    tersedia</td>
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
        });
    </script>
@endpush
