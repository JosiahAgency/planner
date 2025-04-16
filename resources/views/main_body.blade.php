<main class="flex-1 p-6 overflow-auto">
    <div class="h-full flex flex-col">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Tasks</h2>
            <div class="flex space-x-4 text-sm">
                <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                    {{ $pending }} pending
                </div>
                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full">
                    {{ $completed }} completed
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
                    <button class="px-3 py-1 mr-4 text-sm rounded-md bg-indigo-100 text-indigo-700">
                        All
                    </button>
                    <button class="px-3 py-1 mr-4 text-sm rounded-md bg-gray-100 text-gray-600">
                        Pending
                    </button>
                    <button class="px-3 py-1 mr-4 text-sm rounded-md bg-gray-100 text-gray-600">
                        Completed
                    </button>
                </div>
                <div class="ml-auto flex space-x-1">
                    <button class="px-3 py-1 mr-4 text-sm rounded-md bg-indigo-100 text-indigo-700">
                        All Priorities
                    </button>
                    <button class="px-3 py-1 mr-4 text-sm rounded-md bg-red-100 text-red-700">
                        High
                    </button>
                    <button class="px-3 py-1 mr-4 text-sm rounded-md bg-yellow-100 text-yellow-700 ">
                        Medium
                    </button>
                    <button class="px-3 py-1 mr-4 text-sm rounded-md bg-green-100 text-green-700">
                        Low
                    </button>
                </div>
            </div>
        </div>
        <div class="flex-1 overflow-auto">
            {{-- CREATE TASKS --}}
            @include('create_task')
            @include('display_tasks_list')
        </div>
</main>
