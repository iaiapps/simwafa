@extends('layouts.app')

@section('title', 'Data Jurnal Guru')

@section('content')
    <div class="card p-3">
        <div class="table-responsive">
            <table id="table" class="table table-bordered">
                <thead>
                    <tr class="align-middle text-center">
                        <th>No</th>
                        <th>Guru</th>
                        <th>Kelompok</th>
                        <th>Jurnal</th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $teacher->name }} </td>
                            <td>{{ $teacher->cluster->name_cluster ?? 'belum ditentukan ' }}</td>
                            <td class="text-center">{{ $teacher->journal->count() }}</td>

                            <td>
                                <a href="{{ route('journal.show', $teacher->id) }}" class="btn btn-primary btn-sm">lihat
                                    jurnal</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $count + 5 }}" class="text-center">data tidak tersedia</td>
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
            $('#table').DataTable({
                "pageLength": 50,
            });
        });
    </script>
@endpush
