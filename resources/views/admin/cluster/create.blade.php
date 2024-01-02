{{-- @extends('layouts.app')

@section('title', 'Buat Kelompok Baru')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('cluster.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Nama') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name_cluster" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">
                            {{ __('Tambah Kelompok Baru') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection --}}


<form method="POST" action="{{ route('cluster.store') }}">
    <div class="modal fade" id="createCluster" tabindex="1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelompok</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="name_cluster" class="form-label">Nama kelompok</label>
                        <input id="name_cluster" type="text" class="form-control" name="name_cluster"
                            value="{{ old('name_cluster') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</form>
