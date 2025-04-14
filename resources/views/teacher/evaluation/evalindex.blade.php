@extends('layouts.app')

@section('title', 'Data Nilai Siswa')

@section('content')


    <a href="{{ route('coba.nilai') }}" class="btn btn-primary mb-3">coba nilai</a>


    @if ($students->isEmpty())
        <div class="card p-3 text-center">
            <p class="fs-5">Anda belum belum memiliki anggota kelompok</p>
            <p>Hubungi Admin</p>
        </div>
    @else
        <div class="card p-3 mb-3">
            <form action="{{ route('eval.index') }}" method="get">
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
            <div class="card p-3">
                <p class="text-center fs-5 mb-0 rounded">Data nilai siswa : {{ $teacher->cluster->name_cluster }}</p>
                <p class="mb-0">Tahun Pelajaran: {{ $year->year . ' - ' . $year->description }}</p>
                <hr>
                <div class="table-responsive">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Siswa</th>
                                <th class="text-center">Kelas</th>
                                @foreach ($komponens->sortBy('komponen_id') as $komponen)
                                    <th> {{ $komponen->name_komp }}</th>
                                @endforeach
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
                                    <td class="text-center" colspan="10">data nilai tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endif
@endsection
