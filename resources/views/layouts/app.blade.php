<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | CityPulse</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/maps/citypulse-map.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reports/report-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/officer/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/citizen/dashboard.css') }}">
    @stack('styles')
</head>

<body class="bg-dark text-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                CityPulse
            </a>
        </div>
    </nav>

    <main class="container py-5">
        @yield('content')
    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.umd.min.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('js/maps/citypulse-map.js') }}"></script>
    @stack('scripts')


</body>

</html>
