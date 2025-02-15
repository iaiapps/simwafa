@extends('layouts.app')

@section('title', 'Tentukan Kelompok')

@section('content')
    <div class="card rounded p-3">
        <form id="form" action="{{ route('move.grade') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <label class="col-md-2 col-form-label" for="grade">Kelas</label>
                <div class="col-md-10">
                    <select class="form-select" id="grade" name="grade_id">
                        <option disabled selected>---pilih kelas---</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name_grade }}</option>
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
                            {{-- <th scope="col">Kelompok</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr id="ready">
                                <input type="text" value="{{ $student->id }}" name="input[{{ $student->id }}][id]"
                                    hidden>
                                <td>{{ $student->id }}</td>
                                <td>
                                    <input class="form-check-input my-check" type="checkbox"
                                        name="input[{{ $student->id }}][check]">
                                </td>
                                <td class="w-50">{{ $student->name ?? 'belum ditentukan' }}</td>
                                {{-- <td><select class="form-select" name="stage_id[{{ $student->id }}]">
                                        <option selected disabled readonly>--- pilih jilid ---</option>
                                        @foreach ($stages as $stage)
                                            <option value="{{ $stage->id }}">{{ $stage->name_stage }}</option>
                                        @endforeach
                                    </select></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-4">simpan kelompok</button>
        </form>
    </div>

@endsection
@include('layouts.partials.scripts')
@push('css')
    <style>
        .my-check {
            display: inline-block;
            width: 30px;
            height: 30px;
            cursor: pointer;

            /* background-color: green; */
            border: 3px solid rgb(0, 102, 255);

        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#table').DataTable({
                "pageLength": 50,
            });

            $('#form').on('submit', function() {
                // ini untuk mengatasi datatable yang hidden 
                // baik pagination atau search
                // denagan tipe checkboxes
                // Iterate over all checkboxes in the table
                var form = this;
                table.$('input[type="checkbox"]').each(function() {
                    // If checkbox doesn't exist in DOM
                    if (!$.contains(document, this)) {
                        // If checkbox is checked
                        if (this.checked) {
                            // Create a hidden element 
                            $(form).append(
                                $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', this.name)
                                .val(this.value)
                            );
                        }
                    }
                });
            });


            $('#cluster').select2({
                theme: 'bootstrap-5'
            });

        });
    </script>
@endpush
