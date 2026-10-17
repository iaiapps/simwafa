@php
    $user = Auth::user();
    $role = $user->getRoleNames()->first();
    $akses = session()->get('akses');
    $current = Route::currentRouteName();

    $displayName = $user->teacher->name ?? $user->name;
    $initials = collect(preg_split('/\s+/', trim($displayName)))
        ->filter()
        ->take(2)
        ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
        ->implode('');
@endphp

<header class="app-header">
    <a class="brand" href="{{ route('home') }}">
        <img src="{{ asset('img/grades.png') }}" alt="" class="brand-mark" width="38" height="38">
        <span>
            <span class="brand-word d-block">SimWafa</span>
            <span class="brand-sub">SDIT Harapan Umat</span>
        </span>
    </a>

    <button type="button" class="icon-btn d-lg-none" data-sidebar-toggle aria-expanded="false"
        aria-controls="appSidebar" aria-label="Buka menu navigasi">
        <i class="bi bi-list"></i>
    </button>

    <div class="header-context d-none d-md-flex">
        <span>{{ $role ? ucfirst($role) : 'Akun' }}</span>
        <i class="bi bi-chevron-right" aria-hidden="true"></i>
        <span class="crumb-current">@yield('title')</span>
    </div>

    <div class="ms-auto d-flex align-items-center gap-2">
        <div class="dropdown">
            <button class="user-chip" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                aria-label="Menu akun: {{ $displayName }}">
                <span class="avatar" aria-hidden="true">{{ $initials }}</span>
                <span class="chip-name">{{ $displayName }}</span>
                <i class="bi bi-chevron-down" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <h6 class="dropdown-header">{{ $role ? ucfirst($role) : 'Akun' }}</h6>
                </li>
                <li>
                    <a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a>
                </li>
                @if ($role === 'guru' && $akses)
                    <li>
                        <a class="dropdown-item" href="{{ route('akses.walas') }}">
                            <i class="bi bi-arrow-left-right me-2"></i>Ganti akses ({{ $akses }})
                        </a>
                    </li>
                @endif
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger-sw">
                            <i class="bi bi-box-arrow-right me-2"></i>Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
