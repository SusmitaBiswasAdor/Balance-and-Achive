<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Rules\DueDateNotPast;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderByRaw("FIELD(priority, 'high', 'medium', 'low')")->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => ['nullable', 'date', new DueDateNotPast],
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to_do,in_progress,done',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => ['nullable', 'date', new DueDateNotPast],
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:to_do,in_progress,done',
    ]);

    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
        'priority' => $request->priority,
        'status' => $request->status,
    ]);
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}