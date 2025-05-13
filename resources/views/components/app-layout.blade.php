<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- se estiver usando Vite --}}
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    {{ $slot }}
</body>
</html>
