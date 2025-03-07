<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Filmoteca')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qBMnZbH3QmRAaaAboEjK+5jkbljx4FsyxRBBnLU7FDMRAu8sHCOk52c4dAn2Nw0j" crossorigin="anonymous"></script>
</body>

</html>