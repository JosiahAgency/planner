@if ($taskList && $taskList->count() > 0)
    @foreach ($taskList as $task)
        <div class="bg-white rounded-lg shadow hover:shadow-md transition-all transform hover:scale-[1.01] p-4 mb-5">
            <div class="flex items-start">
                <button onClick={}
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
                        <button onClick={onDelete} class="text-gray-400 hover:text-red-500">
                            <TrashIcon size={16} />
                        </button>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">{{ $task->description }}</p>
                    <div class="mt-2 flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="flex items-center text-xs text-gray-500">
                                <img src="/icons/clock-solid.svg" alt="clock" class="mr-1 w-5" srcset="">
                                <p>{{ $task->due_date }} </p>
                            </div>
                            <div class="flex items-center px-2 py-0.5 rounded-full text-xs">
                                @if ($task->priorities == 0)
                                    <span class="ml-1 capitalize px-3 py-1 rounded-md bg-green-100 text-green-700">low
                                        priority</span>
                                @elseif ($task->priorities == 1)
                                    <span
                                        class="ml-1 capitalize px-3 py-1 rounded-md bg-yellow-100 text-yellow-700">medium
                                        priority</span>
                                @elseif ($task->priorities == 2)
                                    <span class="ml-1 capitalize px-3 py-1 rounded-md bg-red-100 text-red-700">high
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
