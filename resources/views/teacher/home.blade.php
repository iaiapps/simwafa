@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        $akses = session()->get('akses');
    @endphp

    @if (session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($akses == 'Guru')
        <div class="row mb-3 align-items-center gy-3">
            <div class="col-md-9 col-12">
                <p class="text-center bg-warning p-2 rounded m-0">
                    Saat ini anda Login sebagai {{ $akses }}
                </p>
            </div>
            <div class="col-md-3 col-12">
                <a href="{{ route('akses.walas') }}" class="btn btn-primary w-100">ganti akses ke
                    Wali Kelas</a>
            </div>
        </div>
        <div class="row px-3 mb-3">
            <div class="col-12 col-md-4 bg-primary p-1">
                <a href="{{ route('student.cluster') }}" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-people fs-3"></i>
                    <span class="d-block">Data kelompok</span>
                </a>
            </div>
            <div class="col-12 col-md-4 bg-warning p-1">
                <a href="{{ route('eval.index') }}" class="nav-link btn btn-outline text-dark">
                    <i class="bi bi-journal-check fs-3"></i>
                    <span class="d-block">Nilai Siswa</span>
                </a>
            </div>
            <div class="col-12 col-md-4 bg-danger p-1">
                <a href="{{ route('student.evaluation') }}" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-list-check fs-3"></i>
                    <span class="d-block">Penilaian</span>
                </a>
            </div>
        </div>
    @elseif ($akses == 'Wali Kelas')
        <div class="row mb-3 align-items-center gy-3">
            <div class="col-md-9 col-12">
                <p class="text-center bg-warning p-2 rounded m-0">
                    Saat ini anda Login sebagai {{ $akses }}
                </p>
            </div>
            <div class="col-md-3 col-12">
                <a href="{{ route('akses.walas') }}" class="btn btn-primary w-100">ganti akses ke
                    Guru</a>
            </div>
        </div>
    @endif



    <div class="card rounded p-3 mb-3">
        <p class="fs-4 text-center m-0">
            Selamat Datang di Sistem Penilaian Wafa SDIT Harapan Umat Jember
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
