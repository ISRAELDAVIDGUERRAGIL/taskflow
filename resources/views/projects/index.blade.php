<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mis Proyectos</h2>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                + Nuevo Proyecto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($projects as $project)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 flex items-center justify-between">
                        <div>
                            <a href="{{ route('projects.show', $project) }}" class="text-lg font-semibold text-indigo-600 hover:text-indigo-900">
                                {{ $project->title }}
                            </a>
                            @if ($project->description)
                                <p class="text-gray-500 mt-1">{{ Str::limit($project->description, 100) }}</p>
                            @endif
                            <p class="text-sm text-gray-400 mt-1">{{ $project->tasks_count }} tareas</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('projects.edit', $project) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Eliminar este proyecto y todas sus tareas?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        No tienes proyectos aún. <a href="{{ route('projects.create') }}" class="text-indigo-600 hover:text-indigo-900">Crea tu primer proyecto</a>.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
