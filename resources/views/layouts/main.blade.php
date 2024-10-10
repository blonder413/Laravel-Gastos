<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/breadcrumbs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font/bootstrap-icons.min.css') }}">
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/vnd.microsoft.icon" />
</head>

<body>

    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="{{ route('welcome') }}" class="nav-link {{ Request::path() == '/' ? 'active':'' }}"
                        aria-current="page">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('gastos.index') }}"
                        class="nav-link {{ Request::path() == 'gastos' ? 'active':'' }}">
                        Gastos
                    </a>
                </li>
            </ul>
        </header>

        <div class="content">@yield('content')</div>
        <footer class="text-center mb-3">
            <small class="text-secondary">
                Desarrollado por Jonathan Morales Salazar<br>
                {{ date("Y") }}<br>
                Laravel: {{ app()->version() }}
            </small>
        </footer>
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/color-nodes.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    @yield('scripts')
</body>

</html>