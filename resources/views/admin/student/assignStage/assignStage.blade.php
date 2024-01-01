@extends('layouts.app')

@section('title', 'Tentukan Jilid')

@section('content')
    <div class="card rounded p-3">
        <form action="{{ route('assign.stage') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <label class="col-md-2 col-form-label" for="stage">Kelas</label>
                <div class="col-md-10">
                    <select class="form-select" id="stage" name="stage_id">
                        <option disabled selected>---pilih jilid---</option>
                        @foreach ($stages as $stage)
                            <option value="{{ $stage->id }}">{{ $stage->name_stage }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Check</th>
                            <th scope="col">Nama</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <input type="text" value="{{ $student->id }}" name="input[{{ $student->id }}][id]"
                                    hidden>
                                <td>{{ $student->id }}</td>
                                <td>
                                    <input class="form-check-input" type="checkbox"
                                        name="input[{{ $student->id }}][check]">
                                </td>
                                <td class="w-75">{{ $student->name ?? 'belum ditentukan' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-4">simpan kelas</button>
        </form>
    </div>


@endsection
@include('layouts.partials.scripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "pageLength": 50
            });
            $('#stage').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endpush
