@extends('layouts.app')

@section('title', 'Edit Jurnal Mengajar')

@section('content')
    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('journal.update', $journal->id) }}">
                @csrf
                @method('PUT')
                <input type="text" value="{{ $journal->teacher_id }}" name="teacher_id" readonly hidden>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" name="date" placeholder="Tanggal" id="date" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="tm" class="form-label">Pertemuan ke ...</label>
                    <input type="text" name="tm" placeholder="Pertemuan ke ..." id="tm" class="form-control"
                        value="{{ $journal->tm }}">
                </div>
                <div class="mb-3">
                    <label for="book" class="form-label">Buku/Surat</label>
                    <input type="text" name="book" placeholder="Buku/Surat" id="book" class="form-control"
                        value="{{ $journal->book }}">
                </div>
                <div class="mb-3">
                    <label for="pages" class="form-label">Halaman/Ayat</label>
                    <input type="text" name="pages" placeholder="Halaman/Ayat" id="pages" class="form-control"
                        value="{{ $journal->pages }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Materi</label>
                    <input type="text" name="description" placeholder="Materi" id="description" class="form-control"
                        value="{{ $journal->description }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection
