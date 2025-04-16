<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">

    <title>Planner</title>
</head>

<body>
    <div class="flex flex-col w-full h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        @include('header')
        <div class="flex flex-1 overflow-hidden">
            @include('side_bar')
            @include('main_body')
        </div>
    </div>
</body>

</html>
