<x-app-layout>
    <h1>Chores</h1>

    <a href="{{ route('chores.create') }}">Create Chore</a>

    @forelse($chores as $chore)
        <div style="margin: 15px 0; padding: 10px; border: 1px solid #ccc;">
            <h3>{{ $chore->title }}</h3>
            <p>Status: {{ $chore->status }}</p>
            <p>Assigned to: {{ $chore->assignedUser->name ?? 'N/A' }}</p>
            <p>Assigned by: {{ $chore->assignedByUser->name ?? 'N/A' }}</p>

            @if($chore->status !== 'completed')
                <form action="{{ route('chores.complete', $chore) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Mark Complete</button>
                </form>
            @endif
        </div>
    @empty
        <p>No chores found.</p>
    @endforelse
</x-app-layout>