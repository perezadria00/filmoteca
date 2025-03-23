@extends('layouts.app')

@section('header')
    <div>
        <h1 class="mt-4">Películas</h1>
    </div>
@endsection

@push('styles')
    <style>
        .menu-container {
            position: absolute;
            top: 42%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;/ display: flex;
            justify-content: center;
            text-align: center;
            gap: 30px;
        }


        .list-group-item {
            background-color: transparent !important;
            border: none;
            font-size: small;
        }

        .list-group-item a {
            color: black !important;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .list-group-item:hover {
            font-size: medium;
        }
    </style>
@endpush

@section('content')
    <div class="container menu-container">
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ url('/filmout/films') }}">Todas las pelis</a></li>
            <li class="list-group-item"><a href="{{ url('/filmout/oldFilms') }}">Pelis antiguas</a></li>
            <li class="list-group-item"><a href="{{ url('/filmout/newFilms') }}">Pelis nuevas</a></li>
            <li class="list-group-item"><a href="{{ url('/filmout/listFilmsByYear') }}">Pelis filtradas por año</a></li>
            <li class="list-group-item"><a href="{{ url('/filmout/listFilmsByGenre') }}">Pelis filtradas por género</a></li>
            <li class="list-group-item"><a href="{{ url('/filmout/sortFilms') }}">Pelis ordenadas por año</a></li>
            <li class="list-group-item"><a href="{{ url('/filmout/countFilms') }}">Contador de películas</a></li>
            <li class="list-group-item"><a href="{{ url('/filmin/create') }}">Añadir una película nueva</a></li>
        </ul>
    </div>
@endsection

@section('footer')
@endsection
