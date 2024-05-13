@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')



    <a href="{{ route('student.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>
    <a href="{{ route('assign.grade') }}" class="btn btn-primary mb-3">Tentukan Kelas</a>
    <a href="{{ route('assign.cluster') }}" class="btn btn-primary mb-3">Tentukan Kelompok dan Jilid</a>
    {{-- <a href="{{ route('assign.stage') }}" class="btn btn-primary mb-3">Tentukan Jilid</a> --}}

    <div class="card p-3 mb-3">
        <p>filter data berdasarkan kelas atau kelompok (pilih salah satu filter)</p>
        <form action="{{ route('student.index') }}" method="get">
            <div class="row">
                <div class="col-4 mb-3">
                    <select name="grade_id" id="grade" class="form-select">
                        <option selected disabled>-- pilih kelas --</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name_grade }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <select name="cluster_id" id="grade" class="form-select">
                        <option selected disabled>-- pilih kelompok --</option>
                        @foreach ($clusters as $cluster)
                            <option value="{{ $cluster->id }}">{{ $cluster->name_cluster }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <button type="submit" class="btn btn-primary">filter data</button>
                </div>
            </div>
        </form>
    </div>


    <div class="card rounded p-3">
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Kelompok</th>
                        <th scope="col">Jilid</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->grade->name_grade ?? 'belum ditentukan' }}</td>
                            <td>{{ $student->cluster->name_cluster ?? 'belum ditentukan' }}</td>
                            <td>{{ $student->stage->name_stage ?? 'belum ditentukan' }}</td>
                            <td>
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">edit</a>

                                <form method="POST" action="{{ route('student.destroy', $student->id) }}" class="d-inline"
                                    onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
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
