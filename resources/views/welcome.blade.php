@extends('layouts.app')

@section('header')
    <div>
        <h1 class="mt-4">Lista de Películas</h1>
    </div>
@endsection

@push('styles')
    <style>
        .films-title,
        .add-film,
        .actors-title,
        .search-actor {
            color: black;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Primera fila: Menús de películas y actores -->
        <div class="row gx-1 d-flex align-items-stretch">
            <div class="col-md-6">
                <div class="h-100">
                    <h3 class="films-title text-center mb-4">Menú de películas</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="/filmout/films">Ver todas las pelis - Editar/eliminar</a></li>
                        <li class="list-group-item"><a href="/filmout/oldFilms">Ver películas antiguas</a></li>
                        <li class="list-group-item"><a href="/filmout/newFilms">Ver películas nuevas</a></li>
                        <li class="list-group-item"><a href="/filmout/listFilmsByYear">Ver películas filtradas por año</a></li>
                        <li class="list-group-item"><a href="/filmout/listFilmsByGenre">Ver películas filtradas por género</a></li>
                        <li class="list-group-item"><a href="/filmout/sortFilms">Ver películas ordenadas de más nuevas a más viejas</a></li>
                        <li class="list-group-item"><a href="/filmout/countFilms">Contador de películas</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="h-100">
                    <h3 class="actors-title text-center">Menú de actores</h3>
                    <ul class="list-group mt-4">
                        <li class="list-group-item"><a href="/actorout/actors">Ver todos los actores</a></li>
                        <li class="list-group-item"><a href="">Contador de actores</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Segunda fila: Formularios de "Añadir Película" y "Buscar Actores por Criterio" -->
        <div class="row gx-1 d-flex align-items-stretch mt-4">
            <div class="col-md-6">
                <form action="{{ route('createFilm') }}" method="post" class="p-4 border rounded bg-light h-100">
                    @csrf
                    <h3 class="add-film mb-4 text-center">Añadir Película</h3>
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="year">Año:</label>
                        <input type="number" id="year" name="year" class="form-control" min="1900" max="2024" required>
                        @error('year')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="genre">Género:</label>
                        <input type="text" id="genre" name="genre" class="form-control" required>
                        @error('genre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">País:</label>
                        <input type="text" id="country" name="country" class="form-control" required>
                        @error('country')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="duration">Duración:</label>
                        <input type="number" id="duration" name="duration" class="form-control" min="60" max="500" required>
                        @error('duration')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="img_url">Imagen (URL):</label>
                        <input type="url" id="img_url" name="img_url" class="form-control" required>
                        @error('img_url')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="insert-selection">Insertar en:</label>
                        <select name="options" id="options" class="mt-4">
                            <option value="db">BBDD</option>
                            <option value="json">JSON</option>
                        </select>
                    </div>
                    <div class="text-center mt-4 d-grid col-3 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <form action="{{ route('listActorsByDecade') }}" method="get" class="p-4 border rounded bg-light h-40">
                    <h3 class="search-actor text-center">Buscar actores por criterio</h3>
                    <label for="decade-selection">Década de nacimiento:</label>
                    <select name="decades" id="decades" class="mt-4">
                        <option value="1980">1980-1989</option>
                        <option value="1990">1990-1999</option>
                        <option value="2000">2000-2009</option>
                        <option value="2010">2010-2019</option>
                        <option value="2020">2020-2029</option>
                    </select>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block mt-4">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection