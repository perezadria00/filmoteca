<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Filmoteca')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Para hacer que el footer se quede en la parte inferior */
        html,
        body {
            height: 100%;
            margin: 0;
        
        }

        body {
            display: flex;
            flex-direction: column;
             
        }

        main {
            flex: 1;
            /* Ocupa todo el espacio disponible */
        }
    </style>

    @stack('styles') <!-- Aquí se insertará el CSS específico de cada vista -->
</head>

<body>
    <!-- Header -->
    <header class="d-flex bg-primary text-white text-center justify-content-center align-items-center" style="height: 100px;">
        <div class="header-content">
        </div>
    </header>


    <!-- Main Content -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        @yield('footer')
        <p>&copy; 2024 Filmoteca</p>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>