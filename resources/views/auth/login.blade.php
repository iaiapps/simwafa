@extends('layouts.loginapp')

@section('title', 'Login')
@section('content')
    <div class="text-center my-3">
        <img src="{{ asset('img/grades.png') }}" class="img-icon" alt="icon">
    </div>

    <div class="text-center my-3">
        <p class="fs-3 m-0">SIMWAFA</p>
        {{-- <p class="fs-4">Sistem Informasi WAFA</p> --}}
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">{{ __('Login') }}</div>

                    <div class="card-body px-md-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label ">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="email@email.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label ">{{ __('Pilih Level') }}</label>
                                <select class="form-select" name="level" required>
                                    <option disabled>---pilih---</option>
                                    <option value="admin">Admin</option>
                                    <option value="walas">Wali Kelas</option>
                                    <option value="guru">Guru</option>
                                </select>
                            </div>
                            <div class="my-4 px-5">
                                <button type="submit" class="btn btn-primary d-block w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .img-icon {
            height: 80px;
        }
    </style>
@endpush
