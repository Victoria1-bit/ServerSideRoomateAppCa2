<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 32px; font-weight: bold; margin-bottom: 20px;">Chores</h1>

        @if(session('success'))
            <div style="margin-bottom: 20px; padding: 12px; background: #d4edda; color: #155724; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->check() && auth()->user()->isAdmin())
            <div style="margin-bottom: 20px;">
                <a href="{{ route('chores.create') }}"
                   style="display: inline-block; padding: 10px 16px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px;">
                    + Create Chore
                </a>
            </div>
        @endif

        @forelse($chores as $chore)
            <div style="border: 1px solid #ccc; padding: 16px; margin-bottom: 16px; border-radius: 8px; background: white;">
                <h3 style="font-size: 24px; margin-bottom: 10px;">{{ $chore->title }}</h3>

                <p style="margin: 6px 0;"><strong>Status:</strong> {{ $chore->status }}</p>
                <p style="margin: 6px 0;"><strong>Due:</strong> {{ $chore->due_date ?? 'N/A' }}</p>
                <p style="margin: 6px 0;"><strong>Assigned to:</strong> {{ $chore->assignedUser->name ?? 'N/A' }}</p>
                <p style="margin: 6px 0;"><strong>Assigned by:</strong> {{ $chore->assignedByUser->name ?? 'N/A' }}</p>

                <div style="margin-top: 12px; display: flex; gap: 10px; flex-wrap: wrap;">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('chores.edit', $chore) }}"
                           style="display: inline-block; padding: 8px 12px; background: #f59e0b; color: white; text-decoration: none; border-radius: 6px;">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('chores.destroy', $chore) }}" onsubmit="return confirm('Delete this chore?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="padding: 8px 12px; background: #dc2626; color: white; border: none; border-radius: 6px; cursor: pointer;">
                                Delete
                            </button>
                        </form>
                    @endif

                    @if($chore->status !== 'completed')
                        <form method="POST" action="{{ route('chores.complete', $chore) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    style="padding: 8px 12px; background: #16a34a; color: white; border: none; border-radius: 6px; cursor: pointer;">
                                Mark Complete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p>No chores found.</p>
        @endforelse
    </div>
</x-app-layout>
