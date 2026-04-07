<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chores
            </h2>
            <a href="{{ route('chores.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                + Add Chore
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($chores->isEmpty())
                <div class="bg-white shadow rounded-lg p-6 text-gray-500">
                    No chores found.
                </div>
            @else
                <div class="space-y-4">
                    @foreach($chores as $chore)
                        <div class="bg-white shadow rounded-lg p-6 flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $chore->title }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Status: {{ $chore->status }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Assigned to: {{ $chore->assignedUser->name ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Assigned by: {{ $chore->assignedByUser->name ?? 'N/A' }}
                                </p>
                            </div>

                            <div class="flex gap-3 text-sm">
                                <a href="{{ route('chores.show', $chore->id) }}"
                                   class="text-blue-600 hover:underline">View</a>

                                <a href="{{ route('chores.edit', $chore->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>

                                <form action="{{ route('chores.destroy', $chore->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this chore?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>