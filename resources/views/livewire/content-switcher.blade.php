<div class="flex flex-1 overflow-hidden">
    <aside class="flex flex-col w-16 border-r border-gray-200 md:w-64 bg-white/80 backdrop-blur-sm">
        <div class="flex-1 p-4">
            <nav class="space-y-1">
                <button wire:click="showMainBody"
                    class="flex items-center px-3 py-2 w-full rounded-md transition-colors {{ $currentView === 'task_list' ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white' : 'text-gray-600 border-2 border-gray-200 hover:bg-indigo-50' }}">
                    <img src="/icons/list-check-solid.svg" alt="" class="w-5 mr-4">
                    <span class="hidden md:inline">Task List</span>
                </button>
                <button wire:click="showCalendarTasks"
                    class="flex items-center px-3 py-2 w-full rounded-md transition-colors {{ $currentView === 'calendar_tasks' ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white' : 'text-gray-600 border-2 border-gray-200 hover:bg-indigo-50' }}">
                    <img src="/icons/calendar-days.svg" alt="" class="w-5 mr-4">
                    <span class="hidden md:inline">Calendar</span>
                </button>
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
    <div class="flex-1">
        @if ($currentView === 'task_list')
            @livewire('task-list-view')
        @elseif($currentView === 'calendar_tasks')
            @livewire('task-calendar-view')
        @endif
    </div>
</div>
