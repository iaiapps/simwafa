@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Input Nilai Siswa</h2>

        <form action="{{ route('simpan.nilai') }}" method="POST">
            @csrf
            <table id="nilai-table" class="table">
                <thead>
                    <td class="bg-secondary-subtle text-center">Nama siswa</td>
                    @foreach ($nilai as $n)
                        <td class="bg-secondary-subtle text-center">{{ $n }}</td>
                    @endforeach
                </thead>
                <tbody>

                    @foreach ($students as $i => $student)
                        <tr>
                            <td class="w-name">
                                <p class="form-control m-0 bg-secondary-subtle">{{ $student->name }}</p>
                            </td>
                            @foreach ($nilai as $j => $m)
                                <td class="text-center" data-row="{{ $i }}" data-col="{{ $j }}">
                                    <input type="text" name="nilai[{{ $i }}][{{ $j }}]"
                                        class="nilai-input p-1 rounded w-input" data-row="{{ $i }}"
                                        data-col="{{ $j }}">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary mt-3">Simpan Nilai</button>
        </form>
    </div>

    <style>
        .w-name {
            width: 100% !important;
        }

        input:focus {
            background-color: #f2fcfd;
        }

        td.selected {
            background-color: #b2ebf2;
            outline: 1px solid #0097a7;
            border-radius: 4px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let isMouseDown = false;
            let selectedCells = [];

            // Navigasi antar input pakai panah
            $('.nilai-input').on('keydown', function(e) {
                const row = parseInt($(this).data('row'));
                const col = parseInt($(this).data('col'));
                let selector = null;

                switch (e.key) {
                    case 'ArrowRight':
                        selector = `[data-row="${row}"][data-col="${col + 1}"]`;
                        break;
                    case 'ArrowLeft':
                        selector = `[data-row="${row}"][data-col="${col - 1}"]`;
                        break;
                    case 'ArrowDown':
                        selector = `[data-row="${row + 1}"][data-col="${col}"]`;
                        break;
                    case 'ArrowUp':
                        selector = `[data-row="${row - 1}"][data-col="${col}"]`;
                        break;
                }

                if (selector) {
                    const nextInput = $(selector);
                    if (nextInput.length) {
                        nextInput.focus();
                        e.preventDefault();
                        clearSelection();
                        $('#nilai-table td').removeClass('selected');

                    }
                }
            });

            // Fungsi bersihkan seleksi
            function clearSelection() {
                $('#nilai-table td').removeClass('selected');
                selectedCells = [];
            }

            // Klik pertama: seleksi cell
            $('#nilai-table td').on('mousedown', function(e) {
                // Abaikan kalau yang diklik adalah input (biar bisa ketik)
                if ($(e.target).is('input')) return;

                e.preventDefault();
                isMouseDown = true;
                clearSelection();

                $(this).addClass('selected');
                selectedCells.push($(this).find('input'));
            });

            // Drag ke cell lain
            $('#nilai-table td').on('mouseover', function(e) {
                if (isMouseDown) {
                    if (!$(this).hasClass('selected')) {
                        $(this).addClass('selected');
                        selectedCells.push($(this).find('input'));
                    }
                }
            });

            // Mouse dilepas
            $(document).on('mouseup', function() {
                isMouseDown = false;
            });

            // Tekan tombol Delete
            $(document).on('keydown', function(e) {
                // Fokus harus di luar input agar tidak ganggu ngetik
                if (e.key === 'Delete' ||
                    e.key === 'Backspace') {
                    selectedCells.forEach(input => input.val(''));
                }
            });

            // Paste dari Excel (aktifkan saat input fokus)
            $('.nilai-input').on('paste', function(e) {
                const clipboardData = e.originalEvent.clipboardData.getData('text');
                const startInput = $(this);
                const startRow = parseInt(startInput.data('row'));
                const startCol = parseInt(startInput.data('col'));

                const rows = clipboardData.trim().split('\n');
                rows.forEach((rowData, i) => {
                    const cols = rowData.split('\t');
                    cols.forEach((value, j) => {
                        const selector =
                            `[data-row="${startRow + i}"][data-col="${startCol + j}"]`;
                        const targetInput = $(selector);
                        if (targetInput.length) {
                            targetInput.val(value.trim());
                        }
                    });
                });

                e.preventDefault();
            });

            // Klik satu cell: seleksi hanya cell itu
            $('#nilai-table td').on('click', function(e) {
                // // Abaikan kalau yang diklik adalah input (biar bisa ngetik)
                // if ($(e.target).is('input')) return;

                clearSelection();
                $(this).addClass('selected');
                selectedCells = [$(this).find('input')];
            });

            // Klik di luar tabel: hapus semua seleksi
            $(document).on('mousedown', function(e) {
                // Kalau kliknya bukan di dalam tabel
                if (!$(e.target).closest('#nilai-table').length) {
                    clearSelection();
                }
            });

        });
    </script>
@endsection
