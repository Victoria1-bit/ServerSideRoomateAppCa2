<x-app-layout>
    <div style="padding: 20px;">
        <h1>Chores</h1>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <a href="{{ route('chores.create') }}">Create Chore</a>

        @forelse($chores as $chore)
            <div style="margin: 15px 0; padding: 10px; border: 1px solid #ccc;">
                <h3>{{ $chore->title }}</h3>
                <p>Status: {{ $chore->status }}</p>
                <p>Assigned to: {{ $chore->assignedUser->name ?? 'N/A' }}</p>
                <p>Assigned by: {{ $chore->assignedByUser->name ?? 'N/A' }}</p>

                <div style="display: flex; gap: 10px; margin-top: 10px;">
                    <a href="{{ route('chores.edit', $chore) }}">Edit</a>

                    @if($chore->status !== 'completed')
                        <form action="{{ route('chores.complete', $chore) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Mark Complete</button>
                        </form>
                    @endif

                    <form action="{{ route('chores.destroy', $chore) }}" method="POST" onsubmit="return confirm('Delete this chore?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No chores found.</p>
        @endforelse
    </div>
</x-app-layout>