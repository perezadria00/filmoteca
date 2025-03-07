@extends('layouts.app')

@section('header')

<div>
    <h1 class="mt-4">Lista de Películas</h1>
</div>
@endsection

@section('content')
<div class="container">
    <!-- Mostrar mensajes de error o éxito -->
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

    <div class="row">
        <!-- Columna izquierda: Lista UL -->
        <div class="col-md-6">
            <h3 class="text-center mb-4">Menú Películas</h3>
            <ul class="list-group">
                <li class="list-group-item"><a href="/filmout/films">Ver todas las pelis - Editar/eliminar </a></li>
                <li class="list-group-item"><a href="/filmout/oldFilms">Ver películas antiguas</a></li>
                <li class="list-group-item"><a href="/filmout/newFilms">Ver películas nuevas</a></li>
                <li class="list-group-item"><a href="/filmout/listFilmsByYear">Ver películas filtradas por año</a></li>
                <li class="list-group-item"><a href="/filmout/listFilmsByGenre">Ver películas filtradas por género</a></li>
                <li class="list-group-item"><a href="/filmout/sortFilms">Ver películas ordenadas de más nuevas a más viejas</a></li>
                <li class="list-group-item"><a href="/filmout/countFilms">Contador de películas</a></li>
            </ul>
        </div>

        <div class="col-md-6">
            <h3 class="text-center mb-4">Menú Actores</h3>
            <ul class="list-group">
                <li class="list-group-item"><a href="/actorout/actors">Ver todos los actores</a></li>
            </ul>
        </div>

        <!-- Columna derecha: Formulario -->
        <div class="col-md-6">
            <form action="{{ route('createFilm') }}" method="post" class="p-4 border rounded bg-light">
                @csrf
                <h3 class="mb-4 text-center">Añadir Película</h3>
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
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                </div>
            </form>
        </div>


    </div>
</div>
@endsection

@section('footer')

@endsection
