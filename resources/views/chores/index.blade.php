<x-app-layout>
    <!-- Main container for the chores page -->
    <div style="padding: 20px;">

        <!-- Page title -->
        <h1 style="font-size: 32px; font-weight: bold; margin-bottom: 20px;">
            Chores
        </h1>

        <!-- Success message after actions like create, update, delete, or complete -->
        @if(session('success'))
            <div style="margin-bottom: 20px; padding: 12px; background: #d4edda; color: #155724; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Only admins can create chores -->
        @if(auth()->check() && auth()->user()->isAdmin())
            <div style="margin-bottom: 20px;">
                <a href="{{ route('chores.create') }}"
                   style="display: inline-block; padding: 10px 16px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px;">
                    + Create Chore
                </a>
            </div>
        @endif

        <!-- Loop through chores -->
        @forelse($chores as $chore)
            <div style="border: 1px solid #ccc; padding: 16px; margin-bottom: 16px; border-radius: 8px; background: white;">

                <!-- Chore title -->
                <h3 style="font-size: 24px; margin-bottom: 10px;">
                    {{ $chore->title }}
                </h3>

                <!-- Chore details -->
                <p style="margin: 6px 0;"><strong>Status:</strong> {{ $chore->status }}</p>
                <p style="margin: 6px 0;"><strong>Due:</strong> {{ $chore->due_date ?? 'N/A' }}</p>
                <p style="margin: 6px 0;"><strong>Assigned to:</strong> {{ $chore->assignedUser->name ?? 'N/A' }}</p>
                <p style="margin: 6px 0;"><strong>Assigned by:</strong> {{ $chore->assignedByUser->name ?? 'N/A' }}</p>

                <!-- Action buttons -->
                <div style="margin-top: 12px; display: flex; gap: 10px; flex-wrap: wrap;">

                    <!-- Edit and Delete are admin only -->
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('chores.edit', $chore->id) }}"
                           style="padding: 6px 12px; background: orange; color: white; text-decoration: none; border-radius: 4px;">
                            Edit
                        </a>

                        <form action="{{ route('chores.destroy', $chore->id) }}" method="POST" onsubmit="return confirm('Delete this chore?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    style="padding: 6px 12px; background: red; color: white; border: none; border-radius: 4px;">
                                Delete
                            </button>
                        </form>
                    @endif

                    <!-- Mark complete can be used on incomplete chores -->
                    @if($chore->status !== 'completed')
                        <form action="{{ route('chores.complete', $chore->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    style="padding: 6px 12px; background: green; color: white; border: none; border-radius: 4px;">
                                Mark Complete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <!-- Message if no chores exist -->
            <p>No chores found.</p>
        @endforelse

    </div>
</x-app-layout>