@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        $akses = session()->get('akses');
    @endphp

    @if (session('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($akses == 'Guru')
        <div class="alert alert-primary">
            <span>Anda Login sebagai {{ $akses }}</span>
            <a href="{{ route('akses.walas') }}" class="btn btn-primary btn-sm float-end">ganti akses ke Wali Kelas</a>
        </div>
    @elseif ($akses == 'Wali Kelas')
        <div class="alert alert-primary">
            <span>Anda Login sebagai {{ $akses }}</span>
            <a href="{{ route('akses.walas') }}" class="btn btn-primary btn-sm float-end">ganti akses ke Guru</a>
        </div>
    @endif

    <div class="card rounded p-3 mb-3">
        <p class="fs-4 text-center m-0">
            Selamat Datang di Sistem Informasi Penilaian Wafa SDIT Harapan Umat Jember
        </p>
    </div>
    <div class="card rounded p-3">
        <ul class="list-group shadow-0">
            <li class="list-group-item">Penilian BTAQ atau Wafa dalam 1 semester mencakup Penilaian Harian, Sumatif Tengah
                Semester (STS)
                dan Sumatif Akhir Semester (SAS)</li>

            <li class="list-group-item">
                Penilaian Harian terdiri dari beberapa komponen penilaian, diisi cukup sekali selama 1 semester yaitu rerata
                dari penilaian tersebut
            </li>
            <li class="list-group-item">
                Penilaian STS dan SAS diisi 1x selama 1 semester
            </li>
        </ul>
        <p class="mt-3 text-center"> Jika ada pertanyaan terkait penilaian BTAQ atau Wafa bisa menghubungi Waka Keagamaan
            atau Admin
            aplikasi</p>
    </div>
@endsection
