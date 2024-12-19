
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-center">Tasks</h1>

    @if (session('success'))
        <div class="mb-4 text-green-600 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($tasks as $task)
            <div class="task bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-2">{{ $task->title }}</h2>
                <p class="mb-2 text-gray-700">{{ $task->description }}</p>
                <p class="mb-2 text-gray-500">Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y, h:i A') }}</p>
                <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-4" id="form-{{ $task->id }}">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="priority-{{ $task->id }}" class="block text-sm font-medium text-gray-700">Priority:</label>
                        <select id="priority-{{ $task->id }}" name="priority" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                            onchange="submitForm({{ $task->id }})">
                            <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }} class="text-green-600">Low</option>
                            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }} class="text-yellow-600">Medium</option>
                            <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }} class="text-red-600">High</option>
                        </select>
                    </div>
                    <div>
                        <label for="status-{{ $task->id }}" class="block text-sm font-medium text-gray-700">Status:</label>
                        <select id="status-{{ $task->id }}" name="status" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                            onchange="submitForm({{ $task->id }})">
                            <option value="to_do" {{ $task->status == 'to_do' ? 'selected' : '' }} class="text-gray-600">To Do</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }} class="text-blue-600">In Progress</option>
                            <option value="done" {{ $task->status == 'done' ? 'selected' : '' }} class="text-green-600">Done</option>
                        </select>
                    </div>
                </form>
                <div class="relative inline-block text-left mt-4">
                    <div>
                        <button onclick="toggleDropdown('dropdown-{{ $task->id }}')" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                            Actions
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div id="dropdown-{{ $task->id }}" class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1 space-y-1" role="none">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">Edit</a>
                            <a href="{{ route('subtasks.index', $task) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-1">Subtasks</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');" role="none">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-2">Delete</button>
                            </form>
                            <a href="{{ route('tasks.create') }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-3">Create Task</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<script>
    function submitForm(taskId) {
        document.getElementById('form-' + taskId).submit();
    }

    function toggleDropdown(id) {
        var element = document.getElementById(id);
        element.classList.toggle('hidden');
    }
</script>
