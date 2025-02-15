@extends('layouts.app')

@section('title', 'Data Kelompok')

@section('content')
    {{-- @dd($students) --}}

    @if ($students->isEmpty())
        <div class="bg-white rounded p-3 text-center">
            <p class="fs-5">Anda belum belum memiliki anggota kelompok</p>
            <a href="{{ route('tassign.cluster') }}" class="btn btn-primary">pilih kelompok</a>
        </div>
    @else
        <div class="card rounded p-3">
            <div>
                <a href="{{ route('tassign.cluster') }}" class="btn btn-primary">Tambah data siswa dalam kelompok</a>
            </div>

            <p class="text-center mb-0 ">Data siswa sesuai kelompok yang telah ditentukan </p>
            <p class="text-center mb-0 fs-5">{{ $teacher->cluster->name_cluster }}</p>
            <hr class="mb-4">
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            {{-- <th scope="col">Kelompok</th> --}}
                            <th scope="col">Kelas</th>
                            <th scope="col">Jilid</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                {{-- <td>{{ $student->cluster->name_cluster ?? 'belum ditentukan' }}</td> --}}
                                <td>{{ $student->grade->name_grade ?? 'belum ditentukan' }}</td>
                                <td>{{ $student->stage->name_stage ?? 'belum ditentukan' }}</td>

                                <td>
                                    <form method="POST" action="{{ route('tdestroy.cluster', $student->id) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
