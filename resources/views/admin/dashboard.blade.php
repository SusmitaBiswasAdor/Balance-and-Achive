@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
        <p class="text-lg mb-6">View key performance indicators and manage the system.</p>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Completed vs. Pending Tasks</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-4 rounded-lg shadow-sm text-center">
                    <h3 class="text-2xl font-bold text-blue-800">Completed Tasks</h3>
                    <p class="text-4xl text-gray-900 mt-2">{{ $taskStats->completed_tasks }}</p>
                </div>
                <div class="bg-red-50 p-4 rounded-lg shadow-sm text-center">
                    <h3 class="text-2xl font-bold text-red-800">Pending Tasks</h3>
                    <p class="text-4xl text-gray-900 mt-2">{{ $taskStats->pending_tasks }}</p>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Top Expense Categories</h2>
            <table class="w-full text-left border-collapse bg-white shadow-md">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-4 text-gray-800 font-semibold">Category</th>
                        <th class="p-4 text-gray-800 font-semibold">Total Spent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topExpenseCategories as $category)
                        <tr class="border-t">
                            <td class="p-4 text-gray-800">{{ $category->category }}</td>
                            <td class="p-4 text-gray-800">${{ number_format($category->total_spent, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
