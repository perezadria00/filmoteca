@extends('layouts.app')
@section('header')
<h1>{{ $title }}</h1>
@endsection
@section('content')

@if(empty($totalFilms))
<FONT COLOR="red">No se ha encontrado ninguna película</FONT>
@else
<p>Total de películas disponibles: <strong>{{ $totalFilms }}</strong></p>
@endif
@endsection
@section('footer')
@endsection
