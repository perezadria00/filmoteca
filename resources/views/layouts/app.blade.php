<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Filmoteca')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            font-family: Oswald;
            color: black;
            background-image: url('/images/cinema.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

        }

        main {
            flex: 1;
        }

        .header-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 15px 0;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;

        }

        /* Estilos de la barra de navegación */
        .navbar {
            display: flex;
            gap: 20px;
        }

        /* Estilos de cada enlace */
        .nav-item {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 5px;
            transition: transform 0.2s ease, font-size 0.2s ease, background 0.3s ease;
        }

        .nav-item:hover {
            transform: scale(1.1);
            border-radius: 5px;
        }
    </style>

    @stack('styles') 
</head>

<body>
    <!-- Header -->
    <header class="header-container">
        <nav class="navbar">
            <a class="nav-item" href="{{ url('/') }}">Inicio</a>
            <a class="nav-item" href="{{ url('/filmout/filmMenu') }}">Películas</a>
            <a class="nav-item" href="{{ url('/actorout/actorMenu') }}">Actores</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-white text-center pt-2">
        @yield('footer')
        <p>&copy; 2024 Filmoteca - Adrià Pérez</p>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
