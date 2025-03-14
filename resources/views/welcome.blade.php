@extends('layouts.app')

@section('header')
    <div>
        <h1 class="mt-4">Lista de Películas</h1>
    </div>
@endsection

@push('styles')

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
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button  >
                        </div>
                    </form>
                </div>

               
            </div>
        </div>
@endsection

@section('footer')
@endsection