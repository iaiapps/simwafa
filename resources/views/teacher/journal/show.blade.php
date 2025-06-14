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
            <small class="text-primary d-block mb-3"><em>silahkan scroll kanan-kiri jika tampilan terpotong</em></small>
            <div class="table-responsive">
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
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
                                <td>{{ \Carbon\carbon::parse($journal->date)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                                <td>{{ $journal->tm }}</td>
                                <td>{{ $journal->book }}</td>
                                <td>{{ $journal->pages }}</td>
                                <td>{{ $journal->description }}</td>
                                <td><a href="{{ route('journal.edit', $journal->id) }}"
                                        class="btn btn-warning btn-sm">edit</a></td>
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
