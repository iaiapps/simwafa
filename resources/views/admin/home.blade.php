@extends('layouts.app')

@section('title', 'Dashboard')

@section('subtitle', 'Ringkasan data akademik semester berjalan.')

@section('actions')
    <a href="{{ route('student.index') }}" class="btn btn-primary">
        <i class="bi bi-people"></i> Data Siswa
    </a>
    <a href="{{ route('evaluation.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-journal-check"></i> Nilai Siswa
    </a>
@endsection

@php
    $user = Auth::user();
    $role = $user->getRoleNames()->first();
    $displayName = $user->teacher->name ?? $user->name;
@endphp

@section('content')
    {{-- Banner sambutan --}}
    <section class="welcome-banner" aria-labelledby="welcomeTitle">
        <div>
            <span class="eyebrow">SDIT Harapan Umat Jember</span>
            <h2 id="welcomeTitle">Selamat datang, {{ $displayName }}</h2>
            <p>Sistem Penilaian Wafa SDIT Harapan Umat Jember. Kelola penilaian BTAQ/Wafa semester ini
                dari satu tempat.</p>
        </div>
        @if ($role === 'admin')
            <a href="{{ route('year.index') }}" class="btn btn-secondary">
                <i class="bi bi-calendar-plus"></i> Kelola Tahun Ajaran
            </a>
        @endif
    </section>

    {{-- Stat bento --}}
    <h2 class="section-title">
        <i class="bi bi-bar-chart-line" aria-hidden="true"></i> Ringkasan Data
    </h2>
    <div class="stat-grid">
        <a class="stat-card" href="{{ route('teacher.index') }}">
            <span class="stat-icon k-caramel" aria-hidden="true"><i class="bi bi-person-check"></i></span>
            <span>
                <span class="stat-label d-block">Total Guru</span>
                <span class="stat-number">{{ $teacher->count() }}</span>
            </span>
        </a>
        <a class="stat-card" href="{{ route('student.index') }}">
            <span class="stat-icon k-sage" aria-hidden="true"><i class="bi bi-people"></i></span>
            <span>
                <span class="stat-label d-block">Total Siswa</span>
                <span class="stat-number">{{ $student->count() }}</span>
            </span>
        </a>
        <a class="stat-card" href="{{ route('grade.index') }}">
            <span class="stat-icon k-info" aria-hidden="true"><i class="bi bi-building"></i></span>
            <span>
                <span class="stat-label d-block">Total Kelas</span>
                <span class="stat-number">{{ $grade->count() }}</span>
            </span>
        </a>
        <a class="stat-card" href="{{ route('cluster.index') }}">
            <span class="stat-icon k-success" aria-hidden="true"><i class="bi bi-diagram-3"></i></span>
            <span>
                <span class="stat-label d-block">Total Kelompok</span>
                <span class="stat-number">{{ $cluster->count() }}</span>
            </span>
        </a>
    </div>

    {{-- Aksi cepat --}}
    <h2 class="section-title">
        <i class="bi bi-lightning" aria-hidden="true"></i> Aksi Cepat
    </h2>
    <div class="action-row">
        <a class="action-tile" href="{{ route('teacher.index') }}">
            <i class="bi bi-person-plus"></i>
            <span class="fw-semibold">Tambah Guru</span>
        </a>
        <a class="action-tile" href="{{ route('student.index') }}">
            <i class="bi bi-person-plus-fill"></i>
            <span class="fw-semibold">Tambah Siswa</span>
        </a>
        <a class="action-tile" href="{{ route('evaluation.index') }}">
            <i class="bi bi-journal-plus"></i>
            <span class="fw-semibold">Input Nilai</span>
        </a>
    </div>

    {{-- Aturan penilaian + kamus predikat --}}
    <div class="row g-3 mt-1">
        <div class="col-12 col-lg-7">
            <div class="card h-100">
                <h2 class="card-header">
                    <i class="bi bi-info-circle me-2"></i>Aturan Penilaian
                </h2>
                <div class="card-body">
                    <ol class="rule-list">
                        <li>Penilaian BTAQ atau Wafa dalam 1 semester mencakup Penilaian Harian, Sumatif
                            Tengah Semester (STS), dan Sumatif Akhir Semester (SAS).</li>
                        <li>Penilaian Harian terdiri dari beberapa komponen penilaian, diisi cukup sekali
                            selama 1 semester yaitu rerata dari penilaian tersebut.</li>
                        <li>Penilaian STS dan SAS diisi 1x selama 1 semester.</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card h-100">
                <h2 class="card-header">
                    <i class="bi bi-award me-2"></i>Kamus Predikat
                </h2>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Angka</th>
                                    <th scope="col">Predikat</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>≥ 90</td>
                                    <td><span class="badge badge-soft-success">A</span></td>
                                    <td>Sangat Baik</td>
                                </tr>
                                <tr>
                                    <td>80–89</td>
                                    <td><span class="badge badge-soft-primary">B</span></td>
                                    <td>Baik</td>
                                </tr>
                                <tr>
                                    <td>70–79</td>
                                    <td><span class="badge badge-soft-info">C</span></td>
                                    <td>Cukup</td>
                                </tr>
                                <tr>
                                    <td>60–69</td>
                                    <td><span class="badge badge-soft-warning">D</span></td>
                                    <td>Perlu Bimbingan</td>
                                </tr>
                                <tr>
                                    <td>&lt; 60</td>
                                    <td><span class="badge badge-soft-danger">E</span></td>
                                    <td>Belum Tuntas</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="mt-4 mb-0 text-body-sw text-center">
        Ada pertanyaan terkait penilaian BTAQ atau Wafa?
        <a href="https://wa.me/6285259691432" class="btn-soft btn btn-sm ms-1">Waka Keagamaan</a>
        <a href="https://wa.me/6285232213939" class="btn-soft btn btn-sm ms-1">Admin Aplikasi</a>
    </p>
@endsection
