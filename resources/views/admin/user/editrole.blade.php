@extends('layouts.app')

@section('title', 'Edit User Baru')

@section('content')

    <div class="card">
        {{-- <div class="card-header bg-success">{{ __('Register') }}</div> --}}
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('role.update', ['urole' => $user->id]) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Nama') }}</label>
                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control" name="name"
                            value="{{ old('name', $user->name) }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-2 col-form-label" for="role">Role</label>
                    <div class="col-md-10">
                        <select class="form-select" id="role" name="role">
                            <option disabled selected>---pilih role---</option>
                            <option value="admin">Admin</option>
                            <option value="walas">Wali Kelas</option>
                            <option value="guru">Guru</option>
                            {{-- <option value="ortu">Orang Tua</option> --}}
                        </select>
                    </div>
                </div>


                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">
                            Simpan data User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
