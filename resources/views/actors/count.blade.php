@extends('layouts.app')
@section('header')
<h1>{{ $title }}</h1>
@endsection
@section('content')

@if(empty($totalActors))
<FONT COLOR="red">No se ha encontrado ningun actor</FONT>
@else
<p>Total de actores disponibles: <strong>{{ $totalActors }}</strong></p>
@endif
@endsection
@section('footer')
@endsection
