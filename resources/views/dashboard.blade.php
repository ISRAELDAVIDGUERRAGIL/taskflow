<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-3xl font-bold text-indigo-600">{{ $projects->count() }}</p>
                    <p class="text-gray-500 text-sm">Proyectos</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-3xl font-bold text-yellow-600">{{ $pendingTasks->count() }}</p>
                    <p class="text-gray-500 text-sm">Tareas Pendientes</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-3xl font-bold text-blue-600">{{ $projects->sum('tasks_count') }}</p>
                    <p class="text-gray-500 text-sm">Total Tareas</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-3xl font-bold text-green-600">{{ auth()->user()->projects()->withWhereHas('tasks', fn($q) => $q->where('status', 'Completada'))->count() }}</p>
                    <p class="text-gray-500 text-sm">Proyectos con tareas completadas</p>
                </div>
            </div>

            @if ($pendingTasks->isNotEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Tareas Pendientes</h3>
                        <div class="space-y-3">
                            @foreach ($pendingTasks as $task)
                                <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $task->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $task->project->title }}</p>
                                    </div>
                                    @if ($task->due_date)
                                        <span class="text-sm {{ $task->isOverdue() ? 'text-red-600 font-medium' : 'text-gray-400' }}">
                                            {{ $task->due_date->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-500">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
