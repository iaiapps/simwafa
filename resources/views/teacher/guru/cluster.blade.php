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
                <a href="{{ route('tassign.cluster') }}" class="btn btn-primary mb-3">Tambah siswa ke kelompok</a>
            </div>

            <p class="text-center mb-0 ">Data kelompok <span class="fs-5"><u>
                        {{ $teacher->cluster->name_cluster }}</u></span></p>
            <p class="text-center mb-3 fs-5"></p>
            <small class="mb-0 fs-small"> <em>Jika ananda sudah pindah atau naik jilid, serta jika ada kesalahan kelompok,
                    bisa dihapus dengan menekan tombol "delete"
                </em></small>
            <hr class="mb-4">
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jilid</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
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
