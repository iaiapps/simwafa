@extends('layouts.app')

@section('title', 'Detail Jurnal')

@section('content')
    <a href="{{ route('journal.create', $teacher_id) }}" class="btn btn-primary mb-3">Tambah Jurnal</a>
    <div class="card p-3">

        @if ($journals->isEmpty())
            <div>
                <p class="text-center fs-5 mb-0">Data jurnal belum ada</p>
            </div>
        @else
            <div>
                <p class="fs-5 text-center">Data Jurnal <span>{{ $journals->first()->teacher->name }}</span> </p>
            </div>
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pertemuan Ke</th>
                            <th>Buku/Surat</th>
                            <th>Halaman/Ayat</th>
                            <th>Materi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($journals as $journal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $journal->date }}</td>
                                <td>{{ $journal->tm }}</td>
                                <td>{{ $journal->book }}</td>
                                <td>{{ $journal->page }}</td>
                                <td>{{ $journal->description }}</td>
                                <td><a href="{{ route('journal.edit', $journal->id) }}">edit</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif

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


        });
    </script>
@endpush
