@extends('layouts.app')

@section('title', 'Lista de Actores')

@section('header')
    <h2 class="justify-content-center">{{ $title }}</h2>
@endsection

@push('styles')
    <style>
        /* Contenedor para centrar la tabla */
        /* Contenedor para centrar la tabla */
.table-container {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 480px; /* Fijar ancho */
    height: 300px; /* Fijar altura total */
    background: none;
    border: none;
    box-shadow: none;
}

/* Contenedor con scroll */
.table-wrapper {
    width: 100%;
    height: 100%; /* Altura fija */
    overflow-y: auto; /* Scroll siempre activo */
    border-radius: 10px;
    border: none;
    box-shadow: none;
}

/* Evitar que la tabla cambie de tamaño al hacer scroll */
.table {
    width: 100%;
    max-height: 100%; /* Mantener altura fija */
    border-collapse: collapse;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border-radius: 10px;
    overflow: hidden;
    border: none !important;
    box-shadow: none !important;
}

/* Evitar que el thead se mueva al hacer scroll */
.table thead {
    background: #333;
    color: white;
    border: none !important;
    position: sticky;
    top: 0;
    z-index: 100;
}

/* Ajuste de las celdas */
.table th, .table td {
    padding: 12px;
    margin: 0;
    border: none !important;
    font-size: small;
}

/* Scroll en el cuerpo de la tabla en lugar de en toda la tabla */
.table tbody {
    display: block;
    max-height: 230px; /* Fijar altura para el scroll */
    overflow-y: auto;
    width: 100%;
}

/* Evitar que las columnas se rompan al usar display:block en tbody */
.table thead,
.table tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed; /* Mantener el ancho correcto */
}

/* Estilos alternativos para filas */
.table-striped tbody tr:nth-of-type(odd) {
    background: rgba(255, 255, 255, 0.1);
}

.table-striped tbody tr:nth-of-type(even) {
    background: rgba(255, 255, 255, 0.05);
}

/* Efecto hover */
.table tbody tr:hover {
    background: rgba(255, 255, 255, 0.3);
    transition: background 0.3s ease;
}

/* Imagen de los actores */
.table img {
    border-radius: 8px;
    transition: transform 0.3s ease;
    width: 80px;
    height: auto;
}

.table img:hover {
    transform: scale(1.2);
}

/* Evitar bordes extra */
.table *,
.table-wrapper *,
.table-container * {
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
}

    </style>
@endpush






@section('content')
    <div class="table-container">
        @if(empty($actors))
            <div class="alert alert-danger text-center" role="alert">
                No se ha encontrado ningún actor.
            </div>
        @else
            <div class="table-wrapper"> <!-- Contenedor con scroll -->
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
                                <td>{{ $actor->name }}</td>
                                <td>{{ $actor->surname }}</td>
                                <td>{{ $actor->birthdate }}</td>
                                <td>{{ $actor->country }}</td>
                                <td>
                                    <img src="{{ $actor->img_url }}" alt="{{ $actor->name }}" class="img-fluid">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection



@section('footer')
@endsection


