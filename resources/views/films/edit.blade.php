@extends('layouts.app')

@section('title', 'Editar Película')

@section('content')
    <h2 class="text-center">Editar Película</h2>
    
    <form action="{{ route('updateFilm', ['id' => $film->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $film->name) }}" required>
        </div>
        
        <div class="form-group">
            <label for="year">Año</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $film->year) }}" required>
        </div>
        
        <div class="form-group">
            <label for="genre">Género</label>
            <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $film->genre) }}" required>
        </div>
        
        <div class="form-group">
            <label for="country">País</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $film->country) }}" required>
        </div>
        
        <div class="form-group">
            <label for="duration">Duración (minutos)</label>
            <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', $film->duration) }}" required>
        </div>
        
        <div class="form-group">
            <label for="img_url">URL de la Imagen</label>
            <input type="url" class="form-control" id="img_url" name="img_url" value="{{ old('img_url', $film->img_url) }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    </form>
@endsection
