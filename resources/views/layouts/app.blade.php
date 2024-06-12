<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FruitLearning')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}" />

    @yield('style')

</head>
<body class="custom-background">

    <!-- Header / Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item p-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'decision-tree' || Route::is('decision-tree.*') ? 'active' : '' }}" href="{{ route('decision-tree') }}">Decision Tree</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'svm' || Route::is('svm.*') ? 'active' : '' }}" href="{{ route('svm') }}">SVM</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="custom-bg-overlay"></div>

    <!-- Main Content -->
    <main class="container mt-5 pt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center mt-4">
        <div class="container">
            <div class="m-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" width="100px">
            </div>
            <p><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Entre em contato</a></p>
            <hr>
            <p>&copy; {{ date('Y') }} FruitLearning. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>
