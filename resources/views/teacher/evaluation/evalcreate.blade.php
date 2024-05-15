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
            <p class="text-center fs-5 mb-0 rounded">Buat penilaian siswa sesuai kelompok</p>
            <hr class="mb-4">

            <form method="get" action="{{ route('student.evaluation') }}">
                <label for="komponen_id" class="form-label">Komponen Penilaian</label>
                <div class="input-group mb-3">
                    <select name="komponen_id" class="form-select">
                        <option selected disabled>-- pilih komponen --</option>
                        @foreach ($komponens as $komponen)
                            <option value="{{ $komponen->id }}">{{ $komponen->name_komp }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">
                        Pilih
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($students == null)
        <div class="card p-3 text-center">
            <p class="fs-5">Anda belum belum memiliki anggota kelompok</p>
            <p>Hubungi Admin</p>
        </div>
    @else
        <div class="card">
            @if ($komponen_id !== null)
                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('student.evaluation.store') }}">
                        @csrf
                        <p class="text-center h5 mb-3">Penilian :
                            {{ $komponen_id->name_komp ?? 'Komponen belum dipilih' }}
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Siswa</th>
                                        {{-- <th class="text-center">Kelas</th> --}}
                                        <th class="text-center">
                                            {{ $komponen_id->name_komp ?? 'Komponen belum dipilih' }}
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <input name="komponen_id" value="{{ $komponen_id->id }}" hidden>
                                            <input name="student_id[{{ $student->id }}]" value="{{ $student->id }}"
                                                hidden>
                                            <td>
                                                <span class="bg-secondary-subtle d-block rounded px-1">
                                                    {{ $student->name }}</span>
                                                {{-- <input id="name_student" type="text"
                                                    class="form-control bg-secondary-subtle" name="name_student"
                                                    value="{{ $student->name }}" readonly disabled> --}}
                                            </td>
                                            {{-- <td>{{ $student->grade->name_grade }}</td> --}}
                                            <td style="width: 80px">
                                                <input id="nilai" type="number" class="form-control"
                                                    name="nilai[{{ $student->id }}]" min=0 max=100>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">kelas belum dipilih atau data tidak
                                                tersedia
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
                    <span class="fs-5">Komponen belum dipilih</span>
                </div>
            @endif
        </div>
    @endif


@endsection

@include('layouts.partials.scripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            // $('#siswa').select2({
            //     theme: 'bootstrap-5'
            // });

        });
    </script>
@endpush
