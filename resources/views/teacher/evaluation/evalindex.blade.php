@extends('layouts.app')

@section('title', 'Data Nilai Siswa')

@section('content')

    <div class="card p-3">
        <div class="table-responsive">
            <table id="" class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center">No</th>
                        <th rowspan="2" class="text-center">Siswa</th>
                        <th rowspan="2" class="text-center">Kelas</th>

                        {{-- @foreach ($data_komponen->sortBy('komponen_id') as $data)
                            <th>{{ $data->komponen->name_komp }}</th>
                        @endforeach --}}
                        @php
                            foreach ($students as $student) {
                                $count = $student->evaluation->count();
                            }
                        @endphp

                        <th colspan="{{ $count }}" class="text-center">Nilai</th>
                        <th class="text-center"> Rerata Nilai </th>
                        <th class="text-center"> Action </th>
                    </tr>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->grade->name_grade ?? 'belum ditentukan' }}</td>
                            @foreach ($student->evaluation->sortBy('komponen_id') as $i)
                                <td>
                                    {{ $i->komponen->name_komp }} :
                                    {{ $i->nilai }}
                                </td>
                            @endforeach
                            <td>{{ $student->evaluation->avg('nilai') ?? 'nilai belum ada' }}</td>
                            <td>
                                <a href="{{ route('student.evaluation.show', $student->id) }}"
                                    class="btn btn-warning btn-sm">detail</a>
                            </td>
                        </tr>
                    @empty
                        @php
                            $count = count($data_komponen);
                        @endphp
                        <tr>
                            <td colspan="{{ $count + 5 }}" class="text-center">data nilai tidak
                                tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


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
