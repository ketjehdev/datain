<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    
    {{-- favicon & stylesheet  --}}
    <link rel="icon" href="{{ asset('img/logo4.png') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet">  
    <link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
</head>
<body>

    @include('layout.sidebar')
    
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
    <script src="{{ asset('js/cleave.js') }}"></script>
    <script src="{{ asset('js/rupiah.js') }}"></script>
    <script src="{{ asset('js/rupiah_updt.js') }}"></script>

    @include('layout.popup')

</body>
</html>