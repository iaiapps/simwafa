@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
    @endphp

    <p class="text-center bg-primary p-1 text-white mb-3 rounded">
        Anda Login sebagai {{ $role }}
    </p>

    <div class="card rounded p-3 mb-3">
        <p class="fs-4 text-center m-0">
            Selamat Datang di Sistem Informasi Penilaian Wafa SDIT Harapan Umat Jember
        </p>
    </div>
    {{-- <div id="info" class="mb-3">
        <div class="mt-3 card rounded p-3 flex-row justify-content-between align-items-center">
            <div class="d-flex flex-row align-items-center">
                <span class="fs-4 py-0 px-2 btn btn-outline-success">
                    <i class="bi bi-person-check"></i>
                </span>
                <span class="ms-2 fs-5 "> Total Siswa yang diampu </span>
            </div>
            <button class="bg-success btn btn-success p-1 px-2 fs-5 ">{{ '$sumteacher' }}</button>
        </div>
    </div> --}}
    <div class="card rounded p-3">
        <ul class="list-group">
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
