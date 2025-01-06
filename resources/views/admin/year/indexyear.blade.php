@extends('layouts.app')

@section('title', 'Pilih Tahun')

@section('content')
    <div class="bg-white p-3">
        @foreach ($years as $year)
            <div class="card" style="width: 300px">
                <div class="card-body">
                    <p class="card-title fs-5">Tahun ajaran: {{ $year->year }}</p>
                    <p>{{ $year->description }}</p>
                    <a href="" class="btn btn-primary w-100">pilih</a>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@endsection
