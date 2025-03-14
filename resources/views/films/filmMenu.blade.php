
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
            width: 40%; 
        }

        .list-group-item {
            background-color: transparent !important;
            border: none;
            font-size: small;
            text-align: center;
        }

        .list-group-item a {
            color: black !important;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .list-group-item:hover{
            font-size: medium;
        }

        .films-title {
            color: black !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }
    </style>
@endpush


@section('content')
<div class="col-md-4 menu-container"> 
    <div class="h-100">
        <ul class="list-group">
            <li class="list-group-item"><a href="{{url('/filmout/films')}}">Ver todas las pelis - Editar/eliminar</a></li>
            <li class="list-group-item"><a href="{{url('/filmout/oldFilms')}}">Ver películas antiguas</a></li>
            <li class="list-group-item"><a href="{{url('/filmout/newFilms')}}">Ver películas nuevas</a></li>
            <li class="list-group-item"><a href="{{url('/filmout/listFilmsByYear')}}">Ver películas filtradas por año</a></li>
            <li class="list-group-item"><a href="{{url('/filmout/listFilmsByGenre')}}">Ver películas filtradas por género</a></li>
            <li class="list-group-item"><a href="{{url('/filmout/sortFilms')}}">Ver películas ordenadas de más nuevas a más viejas</a></li>
            <li class="list-group-item"><a href="{{url('/filmout/countFilms')}}">Contador de películas</a></li>
        </ul>
    </div>
</div>
@endsection


@section('footer')
@endsection