@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
    <a href="{{ route('cluster.index') }}" class="btn btn-primary">Lihat Kelompok</a>
    <hr>
    <div class="d-block">
        <a href="{{ route('teacher.create', ['bagian' => 'grade']) }}" class="btn btn-primary mb-3">Tentukan Wali Kelas</a>
        <a href="{{ route('teacher.create', ['bagian' => 'cluster']) }}" class="btn btn-primary mb-3">Tentukan Kelompok</a>
    </div>
    <div class="card rounded p-3">
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Walas Kelas</th>
                        <th scope="col">Kelompok</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->name ?? 'belum ditentukan' }}</td>
                            <td>{{ $teacher->grade->name_grade ?? 'belum ditentukan' }}</td>
                            <td>{{ $teacher->cluster->name_cluster ?? 'belum ditentukan' }}</td>
                            <td>
                                <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-warning btn-sm">edit</a>


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
