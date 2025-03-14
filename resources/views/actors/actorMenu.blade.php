@extends('layouts.app')

@section('header')
    <div>
        <h1 class="mt-4">Actores</h1>
    </div>
@endsection

@push('styles')
    <style>
        .menu-container {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40%;
        }

        .list-group-item {
            background-color: transparent !important;
            border: none;
            font-size: medium;
            text-align: center;
        }

        .list-group-item a {
            color: black !important;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .list-group-item:hover {
            font-size: large;
        }

    </style>
@endpush


@section('content')
    <div class="col-md-4 menu-container">

        <div class="h-100">
            <ul class="list-group mt-4">
                <li class="list-group-item"><a href="/actorout/actors">Ver todos los actores</a></li>
                <li class="list-group-item"><a href="/actorout/actorDecadeFilter">Filtrar actores por década</a></li>
            </ul>
        </div>

    </div>
@endsection


@section('footer')
@endsection
