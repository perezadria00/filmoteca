@extends('layouts.app')

@section('header')
    <div>
        <h1 class="mt-4">Actores</h1>
    </div>
@endsection

@push('styles')
    <style>
        /* Centrar el contenedor en la pantalla */
        .menu-container {
            position: absolute;
            top: 42%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30%;
            background-color: transparent; /* Elimina el fondo */
            padding: 20px;
        }

        /* Quitar el fondo blanco y bordes del formulario */
        .p-4 {
            background: rgba(0, 0, 0, 0.6) !important; /* Fondo semitransparente oscuro */
            border-radius: 10px; /* Bordes redondeados */
            border: none;
            color: white;
        }

        /* Estilos de los títulos */
        .menu-container h3 {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        /* Estilo para los selectores */
        select, input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* Estilos para los botones */
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Mejorar la visibilidad del texto */
        label {
            font-weight: bold;
            color: white;
        }

        /* Opciones del selector */
        select option {
            color: black;
        }
    </style>
@endpush


@section('content')
    <div class="col-md-4 menu-container">
        <form action="{{ route('listActorsByDecade') }}" method="get" class="p-4 border rounded bg-light h-40">
            <label for="decade-selection">Elige una década:</label>
            <select name="decades" id="decades" class="mt-4 secondary">
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
@endsection
@section('footer')
@endsection
