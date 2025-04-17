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
        <header class="flex items-center justify-between p-4 shadow-lg bg-gradient-to-r from-indigo-600 to-purple-600">
            <div class="flex items-center space-x-2">
                <CheckSquareIcon class="w-6 h-6 text-white" />
                <h1 class="text-xl font-bold text-white">TaskTracker</h1>
            </div>

            @if (Auth::check())
                <a href="{{ url()->current() }}?showModal=true"
                    class="flex items-center px-4 py-2 space-x-1 text-indigo-600 transition-colors bg-white rounded-md shadow-sm hover:bg-indigo-50">
                    <img src="/icons/plus-solid.svg" class="w-4 mr-3" alt="" srcset="">
                    <span>New Task</span>
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="flex items-center px-4 py-2 space-x-1 text-indigo-600 transition-colors bg-white rounded-md shadow-sm hover:bg-indigo-50">
                    <span>New Task</span>
                </a>
            @endif
        </header>
        @include('create_task')
        @livewire('content-switcher')
    </div>
</body>

</html>
