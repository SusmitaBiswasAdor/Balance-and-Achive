@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Budget Table -->
    <h1 class="text-2xl font-bold mb-4 text-center text-blue-800">Your Budgets</h1>
    @if ($budgets->isEmpty())
        <p class="text-center">No budgets added yet.</p>
    @else
        <table class="w-full border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Month</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Budget Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Remaining Amount</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($budgets as $budget)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($budget->month_year)->format('F Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $budget->category }}</td>
                        <td class="border border-gray-300 px-4 py-2">${{ number_format($budget->budget_amount, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">${{ number_format($budget->remaining_amount, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <!-- Delete Form -->
                            <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this budget?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #e53e3e; color: white; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;">
                                    Delete
                                </button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div class="text-center mt-4">
    <!-- Add Another Budget Plan Button -->
        <a href="{{ route('budgets.create') }}" 
        class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
        Add Another Budget Plan
        </a>

        <!-- Add Expense to Budget Button -->
        <a href="{{ route('budgets.spend') }}" 
        class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition ml-4">
        Add Expense to Budget
        </a>
    </div>
</div>
@endsection
