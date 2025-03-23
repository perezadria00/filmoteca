@extends('layouts.app')

@section('header')
    <h1>{{ $title }}</h1>
@endsection

@push('styles')
    <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            flex-direction: column;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <div class="center-container">
        @if (empty($totalFilms))
            <p style="color: red;">No se ha encontrado ninguna película</p>
        @else
            <p>Total de películas disponibles: <strong>{{ $totalFilms }}</strong></p>
        @endif
    </div>
@endsection

@section('footer')
@endsection
