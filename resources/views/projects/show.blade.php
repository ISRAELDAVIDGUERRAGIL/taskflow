<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->title }}</h2>
                @if ($project->description)
                    <p class="text-gray-500 text-sm mt-1">{{ $project->description }}</p>
                @endif
            </div>
            <div class="flex gap-2">
                <a href="{{ route('tasks.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    + Nueva Tarea
                </a>
                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Editar Proyecto
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 grid grid-cols-3 gap-4">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-yellow-800">{{ $project->tasks->where('status', 'Pendiente')->count() }}</p>
                    <p class="text-sm text-yellow-600">Pendientes</p>
                </div>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-blue-800">{{ $project->tasks->where('status', 'En Proceso')->count() }}</p>
                    <p class="text-sm text-blue-600">En Proceso</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-green-800">{{ $project->tasks->where('status', 'Completada')->count() }}</p>
                    <p class="text-sm text-green-600">Completadas</p>
                </div>
            </div>

            @forelse ($project->tasks as $task)
                <div class="mb-3">
                    <x-task-card :task="$task" />
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        No hay tareas en este proyecto.
                        <a href="{{ route('tasks.create', $project) }}" class="text-indigo-600 hover:text-indigo-900">Crea la primera tarea</a>.
                    </div>
                </div>
            @endforelse

            <div class="mt-6">
                <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-900">&larr; Volver a proyectos</a>
            </div>
        </div>
    </div>
</x-app-layout>
