@extends('layouts.app')

@section('title', 'Data Komponen Penilaian')

@section('content')

    {{-- <a href="{{ route('komponen.create') }}" class="btn btn-primary mb-3">Tambah Komponen</a> --}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createKomponen">
        Tambah komponen
    </button>

    <div class="card rounded p-3">
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Komponen</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($komponens as $komponen)
                        <tr>
                            <td>{{ $komponen->id }}</td>
                            <td>{{ $komponen->name_komp }}</td>
                            <td>
                                <a href="{{ route('komponen.edit', $komponen->id) }}"
                                    class="btn btn-warning btn-sm">edit</a>

                                {{-- <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editKomponen{{ $komponen->id }}"> edit </button> --}}

                                <form method="POST" action="{{ route('komponen.destroy', $komponen->id) }}"
                                    class="d-inline" onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');">
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

    @include('admin.komponen.create')
    {{-- @include('admin.komponen.edit') --}}
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
