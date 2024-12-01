
@extends('layouts.app')

@section('content')
<div class="dashboard-container bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4">Welcome to Your Dashboard</h1>
        <p class="text-lg mb-6">Manage your tasks and budget efficiently.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="feature bg-blue-100 p-4 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold mb-2">Task Management</h2>
                <p>Organize and track your tasks.</p>
                <div class="mt-4">
                    <a href="{{ route('tasks.index') }}" class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">View Tasks</a>
                    <a href="{{ route('tasks.create') }}" class="inline-block px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition ml-2">Create Task</a>
                </div>
            </div>
            <div class="feature bg-green-100 p-4 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold mb-2">Budget Tracking</h2>
                <p>Keep your finances in check.</p>
            </div>
            <!-- Add more features as needed -->
        </div>
    </div>
</div>
@endsection

