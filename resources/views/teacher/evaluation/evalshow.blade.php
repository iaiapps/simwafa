@extends('layouts.app')

@section('title', 'Detail Nilai')

@section('content')
    <div class="card p-3">

        @if ($evaluations->isEmpty())
            <div>
                <p class="text-center fs-5 mb-0">Data Nilai belum ada</p>
            </div>
        @else
            <div>
                <p class="fs-5 text-center">Data Nilai <span>{{ $evaluations->first()->student->name }}</span></p>
            </div>
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Komponen Penilaian</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $evaluation->komponen->name_komp }}</td>
                                <td>{{ $evaluation->nilai }}</td>
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

            $('#grade').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endpush
