@php
    $user = Auth::user();
    $role = $user->getRoleNames()->first();

    $akses = session()->get('akses');
@endphp

<aside id="sidebar" class="sidebar position-fixed d-sm-block d-none ">
    <div class="vh-100 text-bg-dark px-sm-2 overflow-scroll">
        <small class="d-block text-center pt-3 px-1">{{ $user->teacher->name ?? $user->name }}</small>
        <hr>
        @switch($role)
            @case('admin')
                <ul class="nav nav-pills pb-2 flex-column">
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="nav-link text-center text-sm-start text-white 
                    {{ Route::currentRouteName() == 'home' ? 'active' : '' }} ">
                            <i class="bi bi-house-door menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Home</span>
                            <br class="p-0 m-0 d-sm-none d-block">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Home</small>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('year.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'year.index' ? 'active' : '' }}">
                            <i class="bi bi-calendar4-week menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Tahun Ajaran</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Tahun</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('grade.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'grade.index' ? 'active' : '' }}">
                            <i class="bi bi-building menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Kelas</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Kelas</small>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('cluster.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'cluster.index' ? 'active' : '' }}">
                            <i class="bi bi-diagram-3 menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Kelompok</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Klmpk</small>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('komponen.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'komponen.index' ? 'active' : '' }}">
                            <i class="bi bi-list-check menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Komponen</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Kmpnn</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stage.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'stage.index' ? 'active' : '' }}">
                            <i class="bi bi-graph-up-arrow menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Jilid</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Jilid</small>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('teacher.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'teacher.index' ? 'active' : '' }}">
                            <i class="bi bi-person menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Guru</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Guru</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('journal.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'journal.index' ? 'active' : '' }}">
                            <i class="bi bi-journals menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Jurnal</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Jurnal</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'student.index' ? 'active' : '' }}">
                            <i class="bi bi-people menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Siswa</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Siswa</small>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('evaluation.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'evaluation.index' ? 'active' : '' }}">
                            <i class="bi bi-journal-check menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Nilai Siswa</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Nilai</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
                            <i class="bi bi-person-gear menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Master</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Master</small>
                        </a>
                    </li>
                </ul>
            @break

            @case('guru')
                <ul class="nav nav-pills pb-2 navbar-nav-scroll flex-column ">
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="nav-link text-center text-sm-start text-white 
                    {{ Route::currentRouteName() == 'home' ? 'active' : '' }} ">
                            <i class="bi bi-house-door menu-icon"></i>
                            <span class="ms-2 d-none d-sm-inline">Home</span>
                            <br class="d-sm-none d-inline">
                            <small class="m-0 p-0 d-sm-none d-sm-block">Home</small>
                        </a>
                    </li>
                    @if ($akses == 'Wali Kelas')
                        <li class="nav-item">
                            <a href="{{ route('student.grade') }}"
                                class="nav-link text-center text-sm-start text-white
                        {{ Route::currentRouteName() == 'student.grade' ? 'active' : '' }}">
                                <i class="bi bi-people menu-icon"></i>
                                <span class="ms-2 d-none d-sm-inline">Siswa</span>
                                <br class="d-sm-none d-inline">
                                <small class="m-0 p-0 d-sm-none d-sm-block">Siswa</small>
                            </a>
                        </li>
                    @elseif ($akses == 'Guru')
                        <li class="nav-item">
                            <a href="{{ route('student.cluster') }}"
                                class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'student.cluster' ? 'active' : '' }}">
                                <i class="bi bi-diagram-3 menu-icon"></i>
                                <span class="ms-2 d-none d-sm-inline">Kelompok</span>
                                <br class="d-sm-none d-inline">
                                <small class="m-0 p-0 d-sm-none d-sm-block">Klmpk</small>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('eval.index') }}"
                                class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'eval.index' ? 'active' : '' }}">
                                <i class="bi bi-journal-check menu-icon"></i>
                                <span class="ms-2 d-none d-sm-inline">Nilai</span>
                                <br class="d-sm-none d-inline">
                                <small class="m-0 p-0 d-sm-none d-sm-block">Nilai</small>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('student.evaluation') }}"
                                class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'student.evaluation' ? 'active' : '' }}">
                                <i class="bi bi-list-check menu-icon"></i>
                                <span class="ms-2 d-none d-sm-inline">Penilaian</span>
                                <br class="d-sm-none d-inline">
                                <small class="m-0 p-0 d-sm-none d-sm-block">Penilian</small>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('teacher.journal') }}"
                                class="nav-link text-center text-sm-start text-white
                    {{ Route::currentRouteName() == 'teacher.journal' ? 'active' : '' }}">
                                <i class="bi bi-journals menu-icon"></i>
                                <span class="ms-2 d-none d-sm-inline">Jurnal</span>
                                <br class="d-sm-none d-inline">
                                <small class="m-0 p-0 d-sm-none d-sm-block">Jurnal</small>
                            </a>
                        </li>
                    @endif
                </ul>
            @break

            @default
        @endswitch
        <hr class="mb-1">
        <small class="d-block text-center pb-5 mb-4">versi 1.0.0</small>
    </div>
</aside>
