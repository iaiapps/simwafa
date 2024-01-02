@php
    $user = Auth::user();
    $role = $user->getRoleNames()->first();
    // dd($role);
@endphp

<aside id="sidebar" class="sidebar position-fixed d-sm-block d-none ">
    <div class="vh-100 d-flex flex-column flex-shrink-0 text-bg-dark px-2">
        <span class="text-center mt-3 fs-6">{{ $user->teacher->name ?? $user->name }}</span>
        <hr>

        @switch($role)
            @case('admin')
                <ul class="nav nav-pills pb-2 navbar-nav-scroll flex-column ">
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="nav-link text-center text-sm-start text-white 
                    {{ Route::currentRouteName() == 'home' ? 'active' : '' }} ">
                            <i class="bi bi-house-door menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Home</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('grade.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'grade.index' ? 'active' : '' }}">
                            <i class="bi bi-building menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Kelas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cluster.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'cluster.index' ? 'active' : '' }}">
                            <i class="bi bi-diagram-3 menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Kelompok</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('komponen.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'komponen.index' ? 'active' : '' }}">
                            <i class="bi bi-list-check menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Komponen</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stage.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'stage.index' ? 'active' : '' }}">
                            <i class="bi bi-graph-up-arrow menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Jilid</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('teacher.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'teacher.index' ? 'active' : '' }}">
                            <i class="bi bi-person menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Guru</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'student.index' ? 'active' : '' }}">
                            <i class="bi bi-people menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('evaluation.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'evaluation.index' ? 'active' : '' }}">
                            <i class="bi bi-journal-check menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Nilai Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
                            <i class="bi bi-person-gear menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Master</span>
                        </a>
                    </li>
                </ul>
            @break

            @case('walas' || 'guru')
                <ul class="nav nav-pills pb-2 navbar-nav-scroll flex-column ">
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="nav-link text-center text-sm-start text-white 
                    {{ Route::currentRouteName() == 'home' ? 'active' : '' }} ">
                            <i class="bi bi-house-door menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Home</span>
                        </a>
                    </li>

                    @if ($role == 'walas')
                        <li class="nav-item">
                            <a href="{{ route('student.grade') }}"
                                class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'student.grade' ? 'active' : '' }}">
                                <i class="bi bi-people menu-icon"></i>
                                <span class="ms-2 d-none d-sm-inline">Siswa</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('student.cluster') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'student.cluster' ? 'active' : '' }}">
                            <i class="bi bi-diagram-3 menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Kelompok</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('eval.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'eval.index' ? 'active' : '' }}">
                            <i class="bi bi-journal-check menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Nilai</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('student.evaluation') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'student.evaluation' ? 'active' : '' }}">
                            <i class="bi bi-list-check menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Penilaian</span>
                        </a>
                    </li>
                </ul>
            @break

            @default
        @endswitch

        <hr>
        <small class="text-center mt-2">versi 1.0.0</small>
    </div>
</aside>
