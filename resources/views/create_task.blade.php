@if (request()->has('showModal'))
    <div class="fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-medium">Add New Task</h3>
            </div>
            <form class="p-4" method="POST" action="/createTask">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Title
                        </label>
                        <input type="text" id="title" name="title"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required />
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <textarea id="description" name="description"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                            Due Date *
                        </label>
                        <input type="date" id="due_date" name="due_date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required />
                    </div>
                    <div>
                        <label for="priorities" class="block text-sm font-medium text-gray-700 mb-1">
                            Priority *
                        </label>
                        <select name="priorities" id="priorities"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="2">High</option>
                            <option value="1">Medium</option>
                            <option value="0">Low</option>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status *
                        </label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="1">Completed</option>
                            <option value="0">Pending</option>
                        </select>
                    </div>
                    <input type="hidden" name="owner_id" id="owner_id" value={{ Auth::user()->id }}>
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
