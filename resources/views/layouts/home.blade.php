<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Olá sistema</title>
</head>
<body>
    <div class="p-3 font-bold text-center text-white bg-blue-600 " class="nav">
        Países
    </div>
    <div class="container mx-auto">
        @yield('countries_list')
        @yield('content')
    </div>

</body>
</html>
