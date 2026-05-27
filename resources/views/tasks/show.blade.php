<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $task->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($task->description)
                        <p class="text-gray-700 mb-4">{{ $task->description }}</p>
                    @endif

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-500">Estado:</span>
                            <span class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @switch($task->status)
                                    @case('Pendiente') bg-yellow-100 text-yellow-800 @break
                                    @case('En Proceso') bg-blue-100 text-blue-800 @break
                                    @case('Completada') bg-green-100 text-green-800 @break
                                @endswitch">
                                {{ $task->status }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-500">Proyecto:</span>
                            <a href="{{ route('projects.show', $project) }}" class="ml-1 text-indigo-600 hover:text-indigo-900">{{ $project->title }}</a>
                        </div>
                        @if ($task->due_date)
                            <div>
                                <span class="font-medium text-gray-500">Vence:</span>
                                <span class="ml-1">{{ $task->due_date->format('d/m/Y') }}</span>
                                @if ($task->isOverdue())
                                    <span class="ml-1 text-red-600 font-medium">(Vencida)</span>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('tasks.edit', [$project, $task]) }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Editar Tarea
                        </a>
                        <form action="{{ route('tasks.destroy', [$project, $task]) }}" method="POST"
                              onsubmit="return confirm('Eliminar esta tarea?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('projects.show', $project) }}" class="text-gray-600 hover:text-gray-900">&larr; Volver al proyecto</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
