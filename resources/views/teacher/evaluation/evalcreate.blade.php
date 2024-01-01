@extends('layouts.app')

@section('title', 'Buat Nilai Siswa')

@section('content')
    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-body">
            <form method="get" action="{{ route('student.evaluation') }}">
                <div class="mb-3">
                    <label for="komponen_id" class="form-label">Pilih Komponen Penilaian</label>
                    <select name="komponen_id" id="siswa" class="form-select">
                        <option selected disabled>-- pilih komponen --</option>
                        @foreach ($komponens as $komponen)
                            <option value="{{ $komponen->id }}">{{ $komponen->name_komp }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">
                        Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- @dd($komponen_id) --}}

    <div class="card">
        @if ($komponen_id !== null)
            <div class="card-body mt-3">
                <form method="POST" action="{{ route('student.evaluation.store') }}">
                    @csrf
                    <p class="text-center h5 mb-3">Penilian : {{ $komponen_id->name_komp ?? 'Komponen belum dipilih' }}</p>
                    <div class="table-responsive">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Siswa</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">{{ $komponen_id->name_komp ?? 'Komponen belum dipilih' }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <input name="komponen_id" value="{{ $komponen_id->id }}" hidden>
                                        <input name="student_id[{{ $student->id }}]" value="{{ $student->id }}" hidden>
                                        <td style="width: 25%"> <input id="name_student" type="text"
                                                class="form-control bg-secondary-subtle" name="name_student"
                                                value="{{ $student->name }}" readonly disabled> </td>
                                        <td>{{ $student->grade->name_grade }}</td>
                                        <td>
                                            <input id="nilai" type="number" class="form-control"
                                                name="nilai[{{ $student->id }}]">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">kelas belum dipilih atau data tidak tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">
                            Tambah Nilai
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="card-body text-center">
                <span class="fs-5">komponen belum dipilih</span>
            </div>
        @endif
    </div>



@endsection

@include('layouts.partials.scripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#siswa').select2({
                theme: 'bootstrap-5'
            });
            $('#komponen').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endpush
