<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Celke</title>
    </head>
    <body>
        <h1>Laravel 11</h1>
        <p>Hoje é dia {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <a href="{{ route('courses.index') }}">Listar</a>
    </body>
</html>
