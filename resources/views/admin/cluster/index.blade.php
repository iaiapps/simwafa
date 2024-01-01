@extends('layouts.app')

@section('title', 'Data Kelompok')

@section('content')

    {{-- @dd(Auth::cluster()->hasRole('admin')) --}}
    <a href="{{ route('cluster.create') }}" class="btn btn-primary mb-3">tambah kelompok</a>

    <div class="card rounded p-3">
        <div class="table-responsive">

            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kelompok</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clusters as $cluster)
                        <tr>
                            <td>{{ $cluster->id }}</td>
                            <td>{{ $cluster->name_cluster }}</td>
                            <td>
                                <a href="{{ route('cluster.edit', $cluster->id) }}" class="btn btn-warning btn-sm">edit</a>

                                <form method="POST" action="{{ route('cluster.destroy', $cluster->id) }}" class="d-inline"
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
