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
