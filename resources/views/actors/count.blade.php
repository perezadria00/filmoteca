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
            height: 80vh; /* 100% de la altura de la pantalla */
            flex-direction: column;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <div class="center-container">
        @if (empty($totalActors))
            <p style="color: red;">No se ha encontrado ningún actor</p>
        @else
            <p>Total de actores disponibles: <strong>{{ $totalActors }}</strong></p>
        @endif
    </div>
@endsection

@section('footer')
@endsection
