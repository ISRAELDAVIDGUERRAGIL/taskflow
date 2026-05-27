<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $tasks = $project->tasks;

        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Pendiente,En Proceso,Completada',
            'due_date' => 'nullable|date',
        ]);

        $task = $project->tasks()->create($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Tarea creada exitosamente.');
    }

    public function show(Project $project, Task $task)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.show', compact('project', 'task'));
    }

    public function edit(Project $project, Task $task)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Pendiente,En Proceso,Completada',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Project $project, Task $task)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('projects.show', $project)
            ->with('success', 'Tarea eliminada exitosamente.');
    }
}
