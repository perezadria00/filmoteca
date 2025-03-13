@extends('layouts.app')

@section('title', 'Lista de Actores')

@section('header')
    <h2 class="justify-content-center">{{ $title }}</h2>
@endsection

@section('content')
    @if(empty($actors))
        <div class="alert alert-danger text-center" role="alert">
            No se ha encontrado ningun actor.
        </div>
    @else
        <table class="table table-bordered table-striped text-center">
            
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de nacimiento</th>
                    <th>País</th>
                    <th>Foto</th>

                </tr>


            </thead>
            <tbody>
                @foreach($actors as $actor)
                    <tr>
                        <td>{{ $actor->name}}</td>
                        <td>{{ $actor->surname }}</td>
                        <td>{{ $actor->birthdate }}</td>
                        <td>{{ $actor->country }}</td>
                        <td>
                            <img src="{{ $actor->img_url }}" alt="{{ $actor->name }}" class="img-fluid" style="width: 100px; height: auto;">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('footer')
@endsection


