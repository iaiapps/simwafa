@extends('layouts.app')

@section('title', 'Data Nilai Siswa')

@php
    $count = count($data_komponen);
@endphp

@section('content')
    <div class="card p-3 mb-3">
        <p>filter data berdasarkan kelas </p>
        <form action="{{ route('evaluation.index') }}" method="get">
            <div class="row">
                <div class="input-group mb-3">
                    <select name="grade_id" id="grade" class="form-select">
                        <option selected disabled>-- pilih kelas --</option>
                        {{-- <option value="0">semua kelas</option> --}}
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name_grade }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">filter data</button>
                </div>
            </div>
        </form>
    </div>

    @if ($students == null)
        <div class="card p-3">
            <p class="fs-5 text-center m-0">kelas belum dipilih</p>
        </div>
    @else
        <div class="card p-3">

            <p class="text-center mb-0 fs-5">{{ $grade_name->name_grade }}</p>
            <hr class="mb-3">
            <div class="table-responsive">
                <table id="" class="table table-bordered">
                    <tbody>
                        @dd($evalu)
                        @foreach ($evalu as $e)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $e->student->name }} </td> --}}
                                <td>{{ $e }} </td>

                                <td>sdf</td>
                                {{-- <td>{{ $e->cluster->name_cluster ?? 'belum ditentukan' }}</td> --}}
                                {{-- <td class="p-0">
                                    <table class="table table-bordered m-0">
                                        <tr>
                                            @foreach ($e->evaluation->sortBy('komponen_id') as $nilai => $i)
                                                @if (count($e->evaluation) < count($data_komponen))
                                                    <td style="width:25%">{{ $i->nilai }}
                                                    </td>
                                                    @if ($loop->last)
                                                        <td style="width:25%">-</td>
                                                    @endif
                                                @else
                                                    <td style="width:25%"> {{ $i->nilai }} </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </table>
                                </td>
                                <td colspan="{{ $count }}" class="text-center">
                                    {{ $e->evaluation->avg('nilai') ?? 'nilai belum ada' }}
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif



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
