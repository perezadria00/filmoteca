@extends('layouts.app')

@section('header')
    <div>
        <h1 class="mt-4 text-center">Lista de Películas</h1>
    </div>
@endsection

@push('styles')
    <style>
        .add-film-container {
            min-height: 100vh;
        }

        .form-container {
            width: 700px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

@section('content')
    <div class="container d-flex align-items-center justify-content-center add-film-container">
        <div class="add-film">
            <div class="form-container">
                <form action="{{ route('createFilm') }}" method="post">
                    @csrf
                    <h3 class="text-center mb-4">Añadir Película</h3>

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
                        <label for="duration">Duración (minutos):</label>
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
                        <label for="options">Insertar en:</label>
                        <select name="options" id="options" class="form-control mt-2">
                            <option value="db">BBDD</option>
                            <option value="json">JSON</option>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
