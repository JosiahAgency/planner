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
        <div class="flex flex-col items-center overflow-auto p-0.5">
            @if ($taskList && $taskList->count() > 0)
                @foreach ($taskList as $task)
                    <div class="bg-white rounded-lg  shadow hover:shadow-md transition-all transform hover:scale-[1.01] p-4 mb-5"
                        style="width: 99%">
                        <div class="flex items-start">
                            <button
                                class="mt-1 flex-shrink-0 h-5 w-5
                                            rounded-full border border-gray-300">

                            </button>
                            <div class="ml-3 flex-1">
                                <div class="flex justify-between">
                                    @if ($task->status == 1)
                                        <h3 class="text-sm font-medium text-gray-500 line-through">
                                            {{ $task->title }}
                                        </h3>
                                    @elseif ($task->status == 0)
                                        <h3 class="text-sm font-medium text-gray-900">
                                            {{ $task->title }}
                                        </h3>
                                    @else
                                        <h3 class=" font-bold text-red-900 uppercase">
                                            error reading title
                                        </h3>
                                    @endif
                                    <form wire:submit.prevent="deleteTask({{ $task->id }})">
                                        @csrf
                                        <button type="submit" class="text-gray-400 hover:text-red-500">
                                            <img src="/icons/trash-solid.svg" alt="" srcset=""
                                                class="w-4 transition-all hover:transform hover:rotate-45">
                                        </button>
                                    </form>

                                </div>
                                <p class="mt-1 text-sm text-gray-500">{{ $task->description }}</p>
                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex items-center text-xs text-gray-500">
                                            <img src="/icons/clock-solid.svg" alt="clock" class="mr-1 w-5"
                                                srcset="">
                                            <p>{{ $task->due_date }} </p>
                                        </div>
                                        <div class="flex items-center px-2 py-0.5 rounded-full text-xs">
                                            @if ($task->priorities == 0)
                                                <span
                                                    class="ml-1 capitalize px-3 py-1 rounded-md bg-green-100 text-green-700">low
                                                    priority</span>
                                            @elseif ($task->priorities == 1)
                                                <span
                                                    class="ml-1 capitalize px-3 py-1 rounded-md bg-yellow-100 text-yellow-700">medium
                                                    priority</span>
                                            @elseif ($task->priorities == 2)
                                                <span
                                                    class="ml-1 capitalize px-3 py-1 rounded-md bg-red-100 text-red-700">high
                                                    priority</span>
                                            @else
                                                <span class="ml-1 uppercase text-red-900 font-bold">error
                                                    getting priorities</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-xs text-blue-600">
                                        @if ($task->status == 0)
                                            <span class="text-red-600">
                                                Pending
                                            </span>
                                        @elseif($task->status == 1)
                                            <span class="text-green-600">
                                                Compeleted
                                            </span>
                                        @else
                                            <span class="text-red-900 font-bold uppercase">
                                                ** Error Reading Status **
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-10">
                    <p class="text-gray-500">No tasks found</p>
                </div>
            @endif
        </div>
</main>
