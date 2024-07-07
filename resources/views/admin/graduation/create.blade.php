@extends('layouts.app')

@section('title', 'Luluskan Siswa')

@section('content')
    <div>
        <p>Pilih Kelas</p>
        <form method="POST" action="{{ route('grade_class') }}">
            @csrf
            <div class="input-group mb-3">
                <select class="form-select" name="grade_id">
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->name_grade }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary w-25">pilih</button>
            </div>
        </form>
    </div>

    <div class="card rounded p-3">
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>

                            <td>{{ $student->grade->name_grade }}</td>
                            <td>
                                <form method="get" action="{{ route('move') }}">
                                    <div class="input-group">
                                        <select class="form-select" name="year_id">
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}">{{ $year->name_year }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" value="{{ $student->id }}" name="id" hidden>
                                        <button type="submit" class="btn btn-warning bt-sm">luluskan</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
