@extends('layouts.app')

@section('title', 'Detail Nilai')

@section('content')
    <button class="btn btn-success btn-sm mb-3" onclick="print()"> print raport </button>

    <div class="card p-3" id="printarea">
        @if ($evaluations->isEmpty())
            <div>
                <p class="text-center fs-5 mb-0">Data belum ada</p>
            </div>
        @else
            <div class="p-3">
                <p class="fs-5 text-center mb-1">Laporan Hasil Belajar Baca Tulis Qur'an WAFA </p>
                <p class="text-center fs-5">SDIT Harapan Umat Jember</p>
                <hr class="mb-5">
                <div class="row mb-3">
                    <div class="col-8">
                        <table>
                            <tbody>
                                <tr>
                                    <td> No Induk</td>
                                    <td class="ms-1"> : {{ $student->id }}</td>
                                </tr>
                                <tr>
                                    <td> Nama Lengkap</td>
                                    <td class="ms-1"> : {{ $student->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table>
                            <tbody>
                                <tr>
                                    <td> Jilid Wafa</td>
                                    <td class="ms-1"> : {{ $student->stage->name_stage }} </td>
                                </tr>
                                <tr>
                                    <td>Tahun </td>
                                    <td class="ms-1"> : 2024/2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <table id="table" class="table table-bordered border-secondary">
                    <thead>
                        <tr class="text-center">
                            <th class="bg-secondary-subtle">No</th>
                            <th class="bg-secondary-subtle">Penilaian</th>
                            <th class="bg-secondary-subtle">Nilai</th>
                            <th class="bg-secondary-subtle">Angka</th>
                            <th class="bg-secondary-subtle">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $evaluation->komponen->name_komp }}</td>
                                <td class="text-center">{{ $evaluation->nilai }}</td>
                                <td class="text-center">
                                    @if ($evaluation->nilai >= 90)
                                        A
                                    @elseif($evaluation->nilai >= 80 && $evaluation->nilai < 89)
                                        B
                                    @elseif($evaluation->nilai >= 70 && $evaluation->nilai < 79)
                                        C
                                    @elseif($evaluation->nilai >= 60 && $evaluation->nilai < 69)
                                        D
                                    @elseif($evaluation->nilai >= 0 && $evaluation->nilai < 59)
                                        E
                                    @endif
                                </td>
                                <td>
                                    @if ($evaluation->nilai >= 90)
                                        Ananda sangat baik dalam {{ $evaluation->komponen->name_komp }} BTAQ
                                    @elseif($evaluation->nilai >= 80 && $evaluation->nilai < 89)
                                        Ananda baik dalam {{ $evaluation->komponen->name_komp }} BTAQ
                                    @elseif($evaluation->nilai >= 70 && $evaluation->nilai < 79)
                                        Ananda cukup baik dalam {{ $evaluation->komponen->name_komp }} BTAQ
                                    @elseif($evaluation->nilai >= 60 && $evaluation->nilai < 69)
                                        Ananda perlu bimbingan dalam {{ $evaluation->komponen->name_komp }} BTAQ
                                    @elseif($evaluation->nilai >= 0 && $evaluation->nilai < 59)
                                        Ananda perlu bimbingan dalam {{ $evaluation->komponen->name_komp }} BTAQ
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-3">
                    <p class="mb-1">catatan guru</p>
                    <div class="border boreder-1 border-secondary">
                        <br><br><br><br>
                    </div>
                </div>
                <div>
                    <div class="row text-center">
                        <div class="col">
                            <p class="mb-1 text-white">btaq</p>
                            <p>Koordinator BTAQ</p>
                            <br> <br>
                            <p>({{ $student->grade->teacher->name }})</p>
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <p class="mb-1">Jember, 21 Desember 2024</p>
                            <p>Wali Kelas</p>
                            <br> <br>
                            <p>({{ $student->grade->teacher->name }})</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="float-start me-5 text-center">
                        <p class="mb-1">Jember, 21 Desember 2024</p>
                        <p>Wali Kelas</p>
                        <br> <br>
                        <p>({{ $student->grade->teacher->name }})</p>

                    </div>
                    <div class="float-end me-5 text-center">
                        <p class="mb-1">Jember, 21 Desember 2024</p>
                        <p>Wali Kelas</p>
                        <br> <br>
                        <p>({{ $student->grade->teacher->name }})</p>

                    </div> --}}
            </div>
        @endif

    </div>
@endsection

@push('css')
    <style>
        .logouser {
            width: 1.5cm !important;
        }

        .profil {
            height: 113px;
            width: 76px;
        }

        .img-header {
            height: 55px;
        }

        .ukuran {
            height: 377px;
            width: 302px
        }

        .tbl {
            padding: 1px !important;
        }

        .pdl {
            padding: 4px !important;
        }

        .wphoto {
            width: 90px !important;
        }

        /* allpage */
        @page {
            margin: 8px !important;
            padding: 8px !important;
            font-size: 0.6em
        }

        /* print */
        @media print {
            body {
                visibility: hidden;
                background-color: white !important;
            }

            .page {
                margin: 0px !important;
            }

            #printarea {
                visibility: visible !important;
                position: absolute !important;
                left: 20px;
                right: 0;
                top: 0;
                border: 2px solid rgb(255, 255, 255);
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        print() {
            window.print();
        },
    </script>
@endpush
