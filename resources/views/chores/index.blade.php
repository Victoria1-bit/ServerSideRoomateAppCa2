<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 15px;">Chores</h1>

        @if(session('success'))
            <div style="margin-bottom: 15px; padding: 10px; background: #d4edda; color: #155724; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('chores.create') }}"
           style="display: inline-block; margin-bottom: 20px; padding: 10px 14px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px;">
            + Create Chore
        </a>

        @forelse($chores as $chore)
            <div style="margin-bottom: 15px; padding: 15px; border: 1px solid #ccc; border-radius: 8px; background: white;">
                <h3 style="margin: 0 0 10px 0; font-size: 20px;">{{ $chore->title }}</h3>

                <p><strong>Status:</strong> {{ $chore->status }}</p>
                <p><strong>Assigned to:</strong> {{ $chore->assignedUser->name ?? 'N/A' }}</p>
                <p><strong>Assigned by:</strong> {{ $chore->assignedByUser->name ?? 'N/A' }}</p>

                @if($chore->status !== 'completed')
                    <form action="{{ route('chores.complete', $chore) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            style="margin-top:10px; padding:8px 12px; background:#16a34a; color:white; border:none; border-radius:6px;">
                            Mark Complete
                        </button>
                    </form>
                @endif

                <form action="{{ route('chores.destroy', $chore) }}" method="POST" style="margin-top:10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="padding:8px 12px; background:#dc2626; color:white; border:none; border-radius:6px;">
                        Delete
                    </button>
                </form>
            </div>
        @empty
            <p>No chores found.</p>
        @endforelse
    </div>
</x-app-layout>