@extends('layouts.app')

@section('title', 'Tentukan Kelompok')

@section('content')
    <div class="card rounded p-3">
        <div class="text-center">
            <p class="fs-4 mb-2"> Kelompok {{ $teacher->cluster->name_cluster }}</p>
        </div>

        <form id="form" action="{{ route('tassign.cluster') }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <ul class="list-group list-group-numbered">
                    <li class="list-group-item py-1">Pilih jilid BTAQ</li>
                    <li class="list-group-item py-1">Gunakan fitur "search" untuk mencari siswa</li>
                    <li class="list-group-item py-1">Centang pada kotak</li>
                    <li class="list-group-item py-1">Klik "simpan kelompok"</li>
                </ul>
            </div>
            <hr>
            <input type="text" name="cluster_id" id="" value="{{ $teacher->cluster->id }}" hidden>

            <div class="input-group mb-4">
                <label class="input-group-text bg-secondary-subtle" for="stage">Jilid BTAQ</label>

                <select class="form-select" id="stage" name="stage_id">
                    <option disabled selected>---pilih jilid---</option>
                    @foreach ($stages as $stage)
                        <option value="{{ $stage->id }}">{{ $stage->name_stage }}</option>
                    @endforeach
                </select>

            </div>


            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Check</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
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
                                <td class="w-50">{{ $student->grade->name_grade ?? 'belum ditentukan' }}</td>
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
            border: 3px solid rgb(0, 102, 255);
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#table').DataTable({
                "pageLength": 28,
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
        });
    </script>
@endpush
