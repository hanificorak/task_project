<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>App</title>
    <link href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400&display=swap" rel="stylesheet">

</head>

<style>
    * {
        font-family: 'Nunito', sans-serif;
    }
</style>

<body>
    <div id="app">
        @include('layouts.navbar')
        @yield('content')
        @include('layouts.footer')
        <script src="{{ asset('asset/jquery/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('asset/editor/tinymce.min.js') }}"></script>
        <script src="{{ asset('asset/bootstrap/js/bootstrap.bundle.js') }}"></script>
    </div>

</body>

</html>
