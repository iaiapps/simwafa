@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card rounded p-3">
        <p class="fs-4 text-center m-0">
            Selamat Datang di Sistem Penilaian Wafa SDIT Harapan Umat Jember
        </p>
    </div>

    <div class="container text-center my-3">
        <div class="row">
            <div class="col-12 col-md-4 bg-primary p-2">
                <a href="{{ route('teacher.index') }}" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-person fs-2"></i>
                    <span class="d-block">Data Guru</span>
                </a>
            </div>
            <div class="col-12 col-md-4 bg-warning p-2">
                <a href="{{ route('student.index') }}" class="nav-link btn btn-outline text-dark">
                    <i class="bi bi-people fs-2"></i>
                    <span class="d-block">Data Siswa</span>
                </a>
            </div>
            <div class="col-12 col-md-4 bg-danger p-2">
                <a href="{{ route('evaluation.index') }}" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-journal-check fs-2"></i>
                    <span class="d-block">Nilai Siswa</span>
                </a>
            </div>
        </div>
    </div>

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
        <div class="col-12 col-sm-6">
            <div class="mt-3 card rounded p-3 flex-row justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <span class="fs-4 py-0 px-2 btn btn-outline-success">
                        <i class="bi bi-building"></i>
                    </span>
                    <span class="ms-2 fs-5 "> Total Kelas </span>
                </div>
                <button class="bg-success btn btn-success p-1 px-2 fs-5 ">{{ $grade->count() }}</button>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="mt-3 card rounded p-3 flex-row justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <span class="fs-4 py-0 px-2 btn btn-outline-success">
                        <i class="bi bi-diagram-3"></i>
                    </span>
                    <span class="ms-2 fs-5 "> Total Kelomppok </span>
                </div>
                <button class="bg-success btn btn-success p-1 px-2 fs-5 ">{{ $cluster->count() }}</button>
            </div>
        </div>
    </div>

    <div class="card rounded p-3">
        <ul class="list-group border-0">
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


        <p class="mt-3 text-center"> Jika ada pertanyaan terkait penilaian BTAQ atau Wafa bisa menghubungi <a
                href="wa.me/6285259691432" class="btn btn-primary">Waka Keagamaan
            </a> atau <a href="wa.me/6285232213939" class="btn btn-primary">Admin Aplikasi</a> </p>
    </div>
@endsection
