@extends('layouts.app')

@section('title', 'Data Nilai Siswa')

@section('content')
    <button id="clearAllBtn" class="btn btn-danger">Hapus Semua Nilai</button>

    <div class=" card p-3 mt-3">
        <form action="{{ route('nilai.simpan') }}" method="POST">
            @csrf
            <table id="nilaiTable" class="table table-bordered border-secondary">
                <thead>
                    <tr class="text-center">
                        <td class="bg-secondary-subtle">Nama siswa</td>
                        <td class="bg-secondary-subtle">Nilai 1</td>
                        <td class="bg-secondary-subtle">Nilai 2</td>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($students) --}}
                    @foreach ($students as $student)
                        <tr>
                            <td><input type="text" class="form-control" value="{{ $student->name }}" readonly disabled>
                            </td>
                            <td class="selectable">
                                <input type="text" value="" class="form-input cell">
                            </td>
                            <td class="selectable">
                                <input type="text" value="" class="form-input cell">
                            </td>
                            <td class="selectable">
                                <input type="text" value="" class="form-input cell">
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </form>
    </div>

@endsection
@push('css')
    <style>
        .selected {
            background-color: #c6daf2 !important;
            /* Warna latar belakang saat terseleksi */
            border: 1px solid #007bff !important;
            /* Border saat terseleksi */
        }

        .form-input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #007bff
        }

        td {
            padding: 8px;
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#nilaiTable');
            const cells = $('.selectable');
            let isCtrlPressed = false;
            let isDragging = false;
            let startCell = null;
            let selectedCells = new Set(); // Menyimpan sel yang terseleksi
            let currentCell = null; // Sel yang sedang aktif

            // Fungsi untuk menambahkan atau menghapus seleksi
            function toggleSelection(cell) {
                if (selectedCells.has(cell)) {
                    cell.removeClass('selected');
                    selectedCells.delete(cell);
                } else {
                    cell.addClass('selected');
                    selectedCells.add(cell);
                }
            }

            // Fungsi untuk memilih rentang sel
            function selectRange(start, end) {
                const startIndex = cells.index(start);
                const endIndex = cells.index(end);
                const minIndex = Math.min(startIndex, endIndex);
                const maxIndex = Math.max(startIndex, endIndex);

                for (let i = minIndex; i <= maxIndex; i++) {
                    const cell = $(cells[i]);
                    cell.addClass('selected');
                    selectedCells.add(cell);
                }
            }

            // Fungsi untuk memindahkan fokus ke sel tertentu
            function moveFocus(newCell) {
                if (currentCell) {
                    currentCell.removeClass('selected');
                }
                currentCell = newCell;
                currentCell.addClass('selected');
                currentCell.find('.form-input').focus(); // Fokus ke input di dalam sel
            }

            // Fungsi untuk berpindah sel berdasarkan arah panah
            function moveCell(direction) {
                if (!currentCell) return;

                const currentIndex = cells.index(currentCell);
                let newIndex;

                switch (direction) {
                    case 'up':
                        newIndex = currentIndex - 2; // Pindah ke baris atas
                        break;
                    case 'down':
                        newIndex = currentIndex + 2; // Pindah ke baris bawah
                        break;
                    case 'left':
                        newIndex = currentIndex - 1; // Pindah ke sel kiri
                        break;
                    case 'right':
                        newIndex = currentIndex + 1; // Pindah ke sel kanan
                        break;
                    default:
                        return;
                }

                // Pastikan newIndex berada dalam rentang yang valid
                if (newIndex >= 0 && newIndex < cells.length) {
                    moveFocus($(cells[newIndex]));
                }
            }

            // Event listener untuk Ctrl key
            $(document).on('keydown', function(e) {
                if (e.key === 'Control') {
                    isCtrlPressed = true;
                }

                // Handle tombol panah
                if (e.key === 'ArrowUp') {
                    moveCell('up');
                } else if (e.key === 'ArrowDown') {
                    moveCell('down');
                } else if (e.key === 'ArrowLeft') {
                    moveCell('left');
                } else if (e.key === 'ArrowRight') {
                    moveCell('right');
                }
            });

            $(document).on('keyup', function(e) {
                if (e.key === 'Control') {
                    isCtrlPressed = false;
                }
            });

            // Event listener untuk seleksi sel
            cells.on('mousedown', function(e) {
                if (isCtrlPressed) {
                    // Ctrl + Click: Toggle seleksi
                    toggleSelection($(this));
                } else {
                    // Klik biasa: Hapus semua seleksi dan mulai drag
                    selectedCells.forEach(cell => {
                        cell.removeClass('selected');
                    });
                    selectedCells.clear();
                    startCell = $(this);
                    toggleSelection($(this));
                    isDragging = true;
                }

                // Set sel yang diklik sebagai sel aktif
                moveFocus($(this));
            });

            cells.on('mouseover', function() {
                if (isDragging && startCell !== $(this)) {
                    // Hapus semua seleksi sementara
                    cells.removeClass('selected');
                    selectedCells.clear();

                    // Pilih rentang dari startCell ke sel ini
                    selectRange(startCell, $(this));
                }
            });

            cells.on('mouseup', function() {
                isDragging = false;
                startCell = null;
            });

            // Event listener untuk menghapus nilai input saat Delete/Backspace ditekan
            $(document).on('keydown', function(e) {
                if ((e.key === 'Delete' || e.key === 'Backspace') && selectedCells.size > 0) {
                    selectedCells.forEach(cell => {
                        const input = cell.find('.form-input');
                        if (input) {
                            input.val(''); // Hapus nilai input
                        }
                    });
                }
            });

            // Event listener untuk paste data dari Excel
            table.on('paste', function(e) {
                e.preventDefault(); // Mencegah paste default

                // Ambil data yang di-paste
                const pasteData = e.originalEvent.clipboardData.getData('text/plain');

                // Proses data yang di-paste
                const rows = pasteData.split('\n'); // Pisahkan baris
                const inputs = $('.form-input'); // Ambil semua input

                let inputIndex = 0;
                rows.forEach(row => {
                    const columns = row.split('\t'); // Pisahkan kolom (tab-separated)

                    columns.forEach(column => {
                        if (inputIndex < inputs.length) {
                            const input = $(inputs[inputIndex]);
                            input.val(column.trim()); // Isi nilai ke input
                            inputIndex++;
                        }
                    });
                });
            });

            // Event listener untuk menghapus seleksi saat klik di luar tabel
            $(document).on('click', function(e) {
                if (!table.is(e.target) && table.has(e.target).length === 0) {
                    selectedCells.forEach(cell => {
                        cell.removeClass('selected');
                    });
                    selectedCells.clear();
                }
            });

            // Event listener untuk tombol Hapus Semua
            $('#hapusSemua').on('click', function() {
                $('.cell').val(''); // Hapus semua nilai input
            });
        });
    </script>
@endpush
