<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @include('irrigacao.layout.styles')
    <title>Hortaliças e Hortaliças</title>
</head>

<body>
    <div class="p-2 text-white shadow-md bg-gradient-to-r from-green-900 to-gray-400">
    <a class="ml-5 font-black" href="/" class="ml-5">Sistema de irrigação</a>
    <a href="/" class="ml-5 text-sm">Home</a>
    <a href="/horta" class="ml-5 text-sm">Hortas Salvas</a>
    <a href="/horta/create" class="ml-5 text-sm">Nova Horta</a>
    </div>
    <div id="content">
        @yield('content')
    </div>

</body>
<script src="{{ asset('js/app.js') }}"></script>

</html>
