@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card rounded p-3">
        <p class="fs-4 text-center m-0">
            Selamat Datang di Sistem Informasi Penilaian Wafa SDIT Harapan Umat Jember
        </p>
    </div>

    {{-- <div class="container text-center mb-3">
        <div class="row">
            <div class="col-12 col-md-4 bg-primary p-2">
                <a href="http://sister.sditharum.id:8000/guru/teacher-profile" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-person fs-2"></i>
                    <span class="d-block">Profil</span>
                </a>
            </div>
            <div class="col-12 col-md-4 bg-light p-2">
                <a href="http://sister.sditharum.id:8000/document" class="nav-link btn btn-outline text-dark">
                    <i class="bi bi-card-image fs-2"></i>
                    <span class="d-block">Dokumen</span>
                </a>
            </div>
            <div class="col-12 col-md-4 bg-danger p-2">
                <a href="http://sister.sditharum.id:8000/guru/teacher-presence" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-calendar-check fs-2"></i>
                    <span class="d-block">Presensi</span>
                </a>
            </div>
        </div>
    </div> --}}

    <div id="info" class="row gx-3 mb-3">
        <div class="col-12 col-sm-6">
            <div class="mt-3 card rounded p-3 flex-row justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <span class="fs-4 py-0 px-2 btn btn-outline-success">
                        <i class="bi bi-person-check"></i>
                    </span>
                    <span class="ms-2 fs-5 "> Total Guru </span>
                </div>
                <button class="bg-success btn btn-success p-1 px-2 fs-5 ">{{ $teacher->count() }}</button>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="mt-3 card rounded p-3 flex-row justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <span class="fs-4 py-0 px-2 btn btn-outline-success">
                        <i class="bi bi-person-check"></i>
                    </span>
                    <span class="ms-2 fs-5 "> Total Siswa </span>
                </div>
                <button class="bg-success btn btn-success p-1 px-2 fs-5 ">{{ $student->count() }}</button>
            </div>
        </div>
    </div>

    <div class="card rounded p-3">
        <ul class="list-group text-center">
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
