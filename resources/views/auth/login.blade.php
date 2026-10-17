@extends('layouts.loginapp')

@section('title', 'Login')
@section('content')
    {{-- Panel merek (disembunyikan di <992px, lihat _components.scss) --}}
    <aside class="login-brand">
        <div class="login-brand-top">
            <img src="{{ asset('img/grades.png') }}" alt="" class="brand-mark" width="38" height="38">
            <div>
                <div class="brand-word">SimWafa</div>
                <div class="brand-sub">SDIT Harapan Umat</div>
            </div>
        </div>

        <div>
            <h1 class="login-hero">Penilaian <em>WAFA</em> yang rapi, terukur, dan mudah dipakai.</h1>
            <p class="login-lead">Satu tempat untuk mengelola tahun ajaran, kelas, komponen penilaian,
                jurnal mengajar, dan raport BTAQ/Wafa — untuk admin, guru, dan wali kelas.</p>

            <div class="mt-4">
                <div class="login-feature">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Penilaian Harian, STS, dan SAS dalam satu alur semester</span>
                </div>
                <div class="login-feature">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Raport siap cetak dengan predikat A–E otomatis</span>
                </div>
                <div class="login-feature">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Jurnal mengajar tercatat per pertemuan</span>
                </div>
            </div>
        </div>

        <p class="login-foot">SimWafa by Tim IT SDIT Harum Jember · versi 1.0.0</p>
    </aside>

    {{-- Form login --}}
    <main class="login-form-side">
        <section class="login-card" aria-labelledby="loginTitle">
            <div class="d-flex align-items-center gap-2 mb-3 d-lg-none">
                <img src="{{ asset('img/grades.png') }}" alt="" class="brand-mark" width="38" height="38">
                <div class="brand-word">SimWafa</div>
            </div>

            <h2 class="login-title" id="loginTitle">Masuk ke akun Anda</h2>
            <p class="login-sub">Gunakan email sekolah yang terdaftar.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" required
                        autocomplete="email" autofocus placeholder="nama@email.com" inputmode="email"
                        spellcheck="false" value="{{ old('email') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata sandi</label>
                    <div class="input-affix">
                        <input id="password" name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" required
                            autocomplete="current-password" placeholder="••••••••">
                        <button type="button" class="affix-btn bi bi-eye" data-pw-toggle="password"
                            aria-label="Tampilkan password"></button>
                    </div>

                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-body-sw login-remember" for="remember">Ingat saya</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="small login-hint">Lupa sandi?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk
                </button>
            </form>

            <p class="text-center text-mute mt-4 mb-0 login-hint">
                Belum punya akun? Hubungi admin sekolah.
            </p>
        </section>
    </main>
@endsection
