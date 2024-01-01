@push('css')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/select2-bootstrap-5-theme.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/simplecal/style.css') }}"> --}}
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/arrow/arrow-table.js') }}"></script>
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/simplecal/calender.js') }}"></script> --}}
@endpush
