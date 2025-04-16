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
                    <div class="flex items-center justify-center w-8 h-8 text-white bg-indigo-600 rounded-full">
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
