@extends('layouts.app')

@section('title', 'Data Kelompok')

@section('content')

    <div class="card rounded p-3">
        <p class="text-center fs-5 mb-5 bg-primary text-white rounded p-1">Data siswa yang diampu sesuai pembagian kelompok
        </p>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Kelompok</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jilid</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td class="fw-bold">{{ $student->cluster->name_cluster ?? 'belum ditentukan' }}</td>
                            <td>{{ $student->grade->name_grade ?? 'belum ditentukan' }}</td>
                            <td>{{ $student->stage->name_stage ?? 'belum ditentukan' }}</td>
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
