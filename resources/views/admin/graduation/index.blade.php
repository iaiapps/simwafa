@extends('layouts.app')

@section('title', 'Data Siswa Lulus')

@section('content')

    <!-- Button trigger modal -->
    <a href="{{ route('graduation.create') }}" type="button" class="btn btn-primary mb-3"> Luluskan siswa </a>

    <div class="card rounded p-3">
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tahun lulus</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Kelas</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($graduations as $graduation)
                        <tr>
                            <td>{{ $graduation->id }}</td>
                            <td>{{ $graduation->year->name_year }}</td>
                            <td>{{ $graduation->name }}</td>
                            <td>{{ $graduation->grade->name_grade }}</td>
                            {{-- <td>
                                <a href="{{ route('graduation.edit', $graduation->id) }}"
                                    class="btn btn-warning btn-sm">edit</a>

                                <form method="POST" action="{{ route('graduation.destroy', $graduation->id) }}"
                                    class="d-inline" onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                </form>
                            </td> --}}
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
