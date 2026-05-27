@props(['task'])

<div class="bg-white rounded-lg shadow p-4 border {{ $task->isOverdue() ? 'border-red-300 bg-red-50' : 'border-gray-200' }}">
    <div class="flex items-start justify-between gap-2">
        <div class="flex-1 min-w-0">
            <h4 class="font-semibold text-gray-900 truncate">{{ $task->title }}</h4>
            @if ($task->description)
                <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $task->description }}</p>
            @endif
        </div>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
            @switch($task->status)
                @case('Pendiente') bg-yellow-100 text-yellow-800 @break
                @case('En Proceso') bg-blue-100 text-blue-800 @break
                @case('Completada') bg-green-100 text-green-800 @break
            @endswitch">
            {{ $task->status }}
        </span>
    </div>
    @if ($task->due_date)
        <p class="text-xs text-gray-400 mt-2">
            Vence: {{ $task->due_date->format('d/m/Y') }}
            @if ($task->isOverdue())
                <span class="text-red-600 font-medium">(Vencida)</span>
            @endif
        </p>
    @endif
    <div class="mt-2 flex gap-2">
        <a href="{{ route('tasks.edit', [$task->project_id, $task]) }}"
           class="text-sm text-indigo-600 hover:text-indigo-900">Editar</a>
        <form action="{{ route('tasks.destroy', [$task->project_id, $task]) }}" method="POST"
              onsubmit="return confirm('Eliminar esta tarea?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-sm text-red-600 hover:text-red-900">Eliminar</button>
        </form>
    </div>
</div>
