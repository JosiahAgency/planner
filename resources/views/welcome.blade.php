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
                    <span>New Task</span>
                </a>
            @else
                <a href="/login"
                    class="flex items-center px-4 py-2 space-x-1 text-indigo-600 transition-colors bg-white rounded-md shadow-sm hover:bg-indigo-50">
                    <span>New Task</span>
                </a>
            @endif


        </header>
        <div class="flex flex-1 overflow-hidden">
            <aside class="flex flex-col w-16 border-r border-gray-200 md:w-64 bg-white/80 backdrop-blur-sm">
                <div class="flex-1 p-4">
                    <nav class="space-y-1">
                        <button
                            class="flex items-center px-3 py-2 w-full rounded-md transition-colors bg-gradient-to-r
                            from-indigo-500 to-purple-500 text-white">
                            {{-- <ListTodoIcon class="w-5 h-5 mr-2" /> --}}
                            <span class="hidden md:inline">Task List</span>
                        </button>
                        <button
                            class="flex items-center px-3 py-2 w-full rounded-md transition-colors text-gray-600
                            hover:bg-indigo-50">
                            {{-- <CalendarIcon class="w-5 h-5 mr-2" /> --}}
                            <span class="hidden md:inline">Calendar</span>
                        </button>
                    </nav>
                </div>
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center space-x-2">

                        <div class="hidden md:block">
                            @if (Auth::check())
                                <div
                                    class="flex items-center justify-center w-8 h-8 text-white bg-indigo-600 rounded-full">
                                </div>
                                <p class="text-sm font-medium text-gray-700">Welcome, {{ Auth::user()->name }}</p>
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
            <main class="flex-1 p-6 overflow-auto">
                <div class="h-full flex flex-col">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Tasks</h2>
                        <div class="flex space-x-4 text-sm">
                            <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                                0 pending
                            </div>
                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full">
                                0 completed
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow mb-4 p-4">
                        <div class="flex flex-wrap gap-2 items-center">
                            <div class="flex items-center mr-2">
                                <FilterIcon size={16} class="text-gray-500 mr-1" />
                                <span class="text-sm text-gray-500">Filter:</span>
                            </div>
                            <div class="flex space-x-1">
                                <button class="px-3 py-1 text-sm rounded-md bg-indigo-100 text-indigo-700">
                                    All
                                </button>
                                <button class="px-3 py-1 text-sm rounded-md bg-gray-100 text-gray-600">
                                    Pending
                                </button>
                                <button class="px-3 py-1 text-sm rounded-md bg-gray-100 text-gray-600">
                                    Completed
                                </button>
                            </div>
                            <div class="ml-auto flex space-x-1">
                                <button class="px-3 py-1 text-sm rounded-md bg-indigo-100 text-indigo-700">
                                    All Priorities
                                </button>
                                <button class="px-3 py-1 text-sm rounded-md bg-red-100 text-red-700">
                                    High
                                </button>
                                <button class="px-3 py-1 text-sm rounded-md bg-yellow-100 text-yellow-700 ">
                                    Medium
                                </button>
                                <button class="px-3 py-1 text-sm rounded-md bg-green-100 text-green-700">
                                    Low
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-auto">
                        @if (request()->has('showModal'))
                            <div
                                class="fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center p-4 z-50">
                                <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                                    <div class="flex justify-between items-center p-4 border-b">
                                        <h3 class="text-lg font-medium">Add New Task</h3>
                                    </div>
                                    <form class="p-4" method="POST" action="/createTask">
                                        @csrf
                                        <div class="space-y-4">
                                            <div>
                                                <label for="title"
                                                    class="block text-sm font-medium text-gray-700 mb-1">
                                                    Title
                                                </label>
                                                <input type="text" id="title" name="title"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    required />
                                            </div>
                                            <div>
                                                <label for="description"
                                                    class="block text-sm font-medium text-gray-700 mb-1">
                                                    Description
                                                </label>
                                                <textarea id="description" name="description"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                                            </div>
                                            <div>
                                                <label for="due_date"
                                                    class="block text-sm font-medium text-gray-700 mb-1">
                                                    Due Date *
                                                </label>
                                                <input type="date" id="due_date" name="due_date"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    required />
                                            </div>
                                            <div>
                                                <label for="priorities"
                                                    class="block text-sm font-medium text-gray-700 mb-1">
                                                    Priority *
                                                </label>
                                                <select name="priorities" id="priorities"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                    <option value={2}>High</option>
                                                    <option value={1}>Medium</option>
                                                    <option value={0}>Low</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="status"
                                                    class="block text-sm font-medium text-gray-700 mb-1">
                                                    Status *
                                                </label>
                                                <select name="status" id="status"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                    <option value={1}>Completed</option>
                                                    <option value={0}>Pending</option>
                                                </select>
                                            </div>
                                            <div class="mt-6 flex justify-end space-x-3">
                                                <button type="submit"
                                                    class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-md">
                                                    Add Task
                                                </button>
                                                <a href="{{ url()->current() }}"
                                                    class="px-4 py-2 text-sm text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                                                    Cancel
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
