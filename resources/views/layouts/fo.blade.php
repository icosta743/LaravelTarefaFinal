<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- título que aparece no separador do browser --}}
    <title>Beyond Routes</title>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-yEPZ7jP9S0QKiUQ0m3jjsO4ProIW7wvR9gXkI7JOGa2XVsw53Yke2bsdkBbjmmiX" crossorigin="anonymous">
    {{-- fontes do google --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Playfair+Display:wght@500;700&display=swap" rel="stylesheet">
    {{-- o css, na pasta public/css (o asset() vai buscar à pasta public) --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    {{-- layout master: este menu aparece em todas as páginas que fazem @extends('layouts.fo') --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            {{-- nome do site, leva a homepage --}}
            <a class="navbar-brand" href="{{ route('home') }}">Beyond Routes</a>
            {{-- botão do menu em ecrãs pequenos (telemóvel) --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{-- links do menu, centrados (mx-auto) --}}
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    {{-- páginas públicas: todos podem ver --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('countries.all') }}">Destinations</a>
                    </li>
                    {{-- o link do dashboard só aparece a quem tem login --}}
                    {{-- (a rota também está protegida com o middleware auth) --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endauth
                </ul>

                {{-- lado direito do menu --}}
                @auth
                    {{-- com login: mostra o nome do utilizador --}}
                    <span class="me-3">{{ Auth::user()->name }}</span>

                    {{-- o logout do Fortify tem de ser feito por POST, por isso é um formulário --}}
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-olive">Logout</button>
                    </form>
                @else
                    {{-- sem login: mostra o botão para fazer login --}}
                    <a href="{{ route('login') }}" class="btn btn-olive">Login</a>
                @endauth

            </div>
        </div>
    </nav>

    {{-- o @yield('content') é onde entra o @section('content') de cada página --}}
    <div class="container">

        @yield('content')

    </div>

    {{-- bootstrap em ecrãs pequenos --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-WyOxWvTyr1QaMPfiPJSv76iReVthorl5uWlFtZPyK0IEB0hGzo9y5Bp9mYanr8Bu" crossorigin="anonymous">
    </script>
</body>

</html>
