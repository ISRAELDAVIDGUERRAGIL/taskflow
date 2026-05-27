<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">Resumen de Tareas Pendientes</h3>
                    @if ($pendingTasks->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach ($pendingTasks as $task)
                                <li class="flex items-center justify-between p-3 bg-yellow-50 rounded border border-yellow-200">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $task->title }}</p>
                                        <p class="text-sm text-gray-500">Proyecto: {{ $task->project->title }}</p>
                                    </div>
                                    @if ($task->due_date)
                                        <span class="text-sm text-gray-400">{{ $task->due_date->format('d/m/Y') }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No tienes tareas pendientes.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
