@php
    $user = Auth::user();
    $role = $user->getRoleNames()->first();
    $akses = session()->get('akses');
    $current = Route::currentRouteName();

    $active = fn ($name) => $current === $name ? ' active' : '';
    $currentAttr = fn ($name) => $current === $name ? ' aria-current="page"' : '';
@endphp

<aside class="app-sidebar" id="appSidebar" aria-label="Menu utama">
    <nav class="sidebar-scroll">
        @switch($role)
            @case('admin')
                <div class="nav-section">
                    <span class="nav-section-label">Beranda</span>
                    <a class="side-link{{ $active('home') }}" href="{{ route('home') }}"
                        {!! $currentAttr('home') !!}>
                        <i class="bi bi-house-door"></i><span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <span class="nav-section-label">Data Master</span>
                    <a class="side-link{{ $active('year.index') }}" href="{{ route('year.index') }}"
                        {!! $currentAttr('year.index') !!}>
                        <i class="bi bi-calendar4-week"></i><span>Tahun Ajaran</span>
                    </a>
                    <a class="side-link{{ $active('grade.index') }}" href="{{ route('grade.index') }}"
                        {!! $currentAttr('grade.index') !!}>
                        <i class="bi bi-building"></i><span>Kelas</span>
                    </a>
                    <a class="side-link{{ $active('komponen.index') }}" href="{{ route('komponen.index') }}"
                        {!! $currentAttr('komponen.index') !!}>
                        <i class="bi bi-list-check"></i><span>Komponen</span>
                    </a>
                    <a class="side-link{{ $active('stage.index') }}" href="{{ route('stage.index') }}"
                        {!! $currentAttr('stage.index') !!}>
                        <i class="bi bi-graph-up-arrow"></i><span>Jilid</span>
                    </a>
                    <a class="side-link{{ $active('teacher.index') }}" href="{{ route('teacher.index') }}"
                        {!! $currentAttr('teacher.index') !!}>
                        <i class="bi bi-person"></i><span>Guru</span>
                    </a>
                    <a class="side-link{{ $active('student.index') }}" href="{{ route('student.index') }}"
                        {!! $currentAttr('student.index') !!}>
                        <i class="bi bi-people"></i><span>Siswa</span>
                    </a>
                    <a class="side-link{{ $active('user.index') }}" href="{{ route('user.index') }}"
                        {!! $currentAttr('user.index') !!}>
                        <i class="bi bi-person-gear"></i><span>Pengguna</span>
                    </a>
                </div>

                <div class="nav-section">
                    <span class="nav-section-label">Aktivitas</span>
                    <a class="side-link{{ $active('evaluation.index') }}" href="{{ route('evaluation.index') }}"
                        {!! $currentAttr('evaluation.index') !!}>
                        <i class="bi bi-journal-check"></i><span>Nilai Siswa</span>
                    </a>
                    <a class="side-link{{ $active('journal.index') }}" href="{{ route('journal.index') }}"
                        {!! $currentAttr('journal.index') !!}>
                        <i class="bi bi-journals"></i><span>Jurnal</span>
                    </a>
                </div>
            @break

            @case('guru')
                <div class="nav-section">
                    <span class="nav-section-label">Beranda</span>
                    <a class="side-link{{ $active('home') }}" href="{{ route('home') }}"
                        {!! $currentAttr('home') !!}>
                        <i class="bi bi-house-door"></i><span>Dashboard</span>
                    </a>
                </div>

                @if ($akses == 'Wali Kelas')
                    <div class="nav-section">
                        <span class="nav-section-label">Wali Kelas</span>
                        <a class="side-link{{ $active('student.grade') }}" href="{{ route('student.grade') }}"
                            {!! $currentAttr('student.grade') !!}>
                            <i class="bi bi-people"></i><span>Siswa</span>
                        </a>
                    </div>
                @elseif ($akses == 'Guru')
                    <div class="nav-section">
                        <span class="nav-section-label">Penilaian</span>
                        <a class="side-link{{ $active('student.cluster') }}"
                            href="{{ route('student.cluster') }}" {!! $currentAttr('student.cluster') !!}>
                            <i class="bi bi-diagram-3"></i><span>Kelompok</span>
                        </a>
                        <a class="side-link{{ $active('eval.index') }}" href="{{ route('eval.index') }}"
                            {!! $currentAttr('eval.index') !!}>
                            <i class="bi bi-journal-check"></i><span>Nilai</span>
                        </a>
                        <a class="side-link{{ $active('student.evaluation') }}"
                            href="{{ route('student.evaluation') }}" {!! $currentAttr('student.evaluation') !!}>
                            <i class="bi bi-list-check"></i><span>Penilaian</span>
                        </a>
                    </div>

                    <div class="nav-section">
                        <span class="nav-section-label">Aktivitas</span>
                        <a class="side-link{{ $active('teacher.journal') }}"
                            href="{{ route('teacher.journal') }}" {!! $currentAttr('teacher.journal') !!}>
                            <i class="bi bi-journals"></i><span>Jurnal</span>
                        </a>
                    </div>
                @endif
            @break

            @default
        @endswitch
    </nav>
    <div class="sidebar-foot">versi 1.0.0</div>
</aside>
<div class="sidebar-backdrop" data-sidebar-backdrop hidden></div>
