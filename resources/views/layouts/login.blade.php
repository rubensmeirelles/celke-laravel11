<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <title>Celke</title>
</head>
<body class="bg-primary">
    @yield('content')
</body>
</html>
