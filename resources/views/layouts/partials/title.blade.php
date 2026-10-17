<div class="page-head">
    <div>
        <nav aria-label="Breadcrumb">
            <ol class="breadcrumb breadcrumb-sw">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
        <h1 class="page-title">@yield('title')</h1>
        @hasSection('subtitle')
            <p class="page-sub">@yield('subtitle')</p>
        @endif
    </div>
    @hasSection('actions')
        <div class="page-actions">@yield('actions')</div>
    @endif
</div>
