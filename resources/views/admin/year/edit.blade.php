@extends('layouts.app')

@section('title', 'Edit Jilid')

@section('content')
    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('year.update', $year->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="year" class="form-label">Tahun</label>
                    <input id="year" type="text" class="form-control" name="year" value="{{ $year->year }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Keterangan</label>
                    <select name="description" id="description" class="form-select">
                        <option disabled>--- pilih semester ---</option>
                        <option>Ganjil</option>
                        <option>Genap</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success"> simpan data </button>
            </form>
        </div>
    </div>
@endsection
