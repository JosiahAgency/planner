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
        <div class="flex flex-1 overflow-hidden">
            <aside class="flex flex-col w-16 border-r border-gray-200 md:w-64 bg-white/80 backdrop-blur-sm">
                <div class="flex-1 p-4">
                    <nav class="space-y-1">
                        <a href="{{ url()->current() }}?view=list"
                            class="flex items-center px-3 py-2 w-full rounded-md transition-colors {{ request('view', 'list') !== 'calendar' ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white' : 'text-gray-600 border-2 border-gray-200 hover:bg-indigo-50' }}">
                            <img src="/icons/list-check-solid.svg" alt="" class="w-5 mr-4">
                            <span class="hidden md:inline">Task List</span>
                        </a>
                        <a href="{{ url()->current() }}?view=calendar"
                            class="flex items-center px-3 py-2 w-full rounded-md transition-colors {{ request('view', 'list') === 'calendar' ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white' : 'text-gray-600 border-2 border-gray-200 hover:bg-indigo-50' }}">
                            <img src="/icons/calendar-days.svg" alt="" class="w-5 mr-4">
                            <span class="hidden md:inline">Calendar</span>
                        </a>
                    </nav>
                </div>
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center space-x-2">

                        <div class="hidden md:block">
                            @if (Auth::check())
                                <!-- Profile Popup -->
                                <div class="relative inline-block">
                                    <!-- Profile Button -->
                                    <button id="profileButton"
                                        class="inline-flex justify-center w-full rounded-md bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-sm px-4 py-2 bg-white text-sm font-medium hover:transform hover:scale-105 hover:transition-all focus:outline-none">
                                        Welcome, {{ Auth::user()->name }}
                                    </button>

                                    <!-- Popup Menu -->
                                    <div id="profileMenu"
                                        class="hidden absolute -top-24 -right-60 w-56 rounded-md shadow-lg bg-white ring-1 ring-indigo-600 ring-opacity-5">
                                        <div class="py-1">
                                            <!-- User Info -->
                                            <div class="px-4 py-2 text-sm text-gray-700">
                                                <p class="font-medium">{{ Auth::user()->name }}</p>
                                                <p class="text-gray-500">{{ Auth::user()->email }}</p>
                                            </div>
                                            <hr class="border-gray-200">
                                            <!-- Logout Button -->
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit"
                                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                    Logout
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <button
                                    class="flex justify-center items-center px-4 py-2 gap-3 bg-indigo-600 outline-3 outline-indigo-600 outline-offset-[3px] rounded-md border-none cursor-pointer transition duration-[400ms] hover:bg-transparent">
                                    <a href="/login"
                                        class="text-white font-bold text-base transition duration-[400ms] hover:text-indigo-600">
                                        Login
                                    </a>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </aside>
            <div id="mainContent" class="flex-1">
                @include('create_task')
                @if (request('view', 'list') === 'calendar')
                    @include('calendar_tasks')
                @else
                    @include('main_body')
                @endif
            </div>
        </div>
    </div>
</body>

</html>
