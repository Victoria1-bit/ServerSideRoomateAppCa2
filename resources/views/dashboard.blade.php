<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 30px; font-weight: bold; margin-bottom: 20px;">Dashboard</h1>

        <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px;">
            <div style="flex: 1; min-width: 200px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white;">
                <h2 style="font-size: 18px; margin-bottom: 10px;">Total Chores</h2>
                <p style="font-size: 28px; font-weight: bold;">{{ $totalChores }}</p>
            </div>

            <div style="flex: 1; min-width: 200px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white;">
                <h2 style="font-size: 18px; margin-bottom: 10px;">Completed</h2>
                <p style="font-size: 28px; font-weight: bold; color: green;">{{ $completedChores }}</p>
            </div>

            <div style="flex: 1; min-width: 200px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white;">
                <h2 style="font-size: 18px; margin-bottom: 10px;">Pending</h2>
                <p style="font-size: 28px; font-weight: bold; color: #d97706;">{{ $pendingChores }}</p>
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <a href="{{ route('chores.index') }}"
               style="display: inline-block; margin-right: 10px; padding: 10px 14px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px;">
                View Chores
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('chores.create') }}"
                   style="display: inline-block; padding: 10px 14px; background: #16a34a; color: white; text-decoration: none; border-radius: 6px;">
                    Add Chore
                </a>
            @endif
        </div>

        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white;">
            <h2 style="font-size: 22px; font-weight: bold; margin-bottom: 15px;">Recent Chores</h2>

            @if($recentChores->count())
                @foreach($recentChores as $chore)
                    <div style="padding: 12px 0; border-bottom: 1px solid #eee;">
                        <h3 style="margin: 0 0 5px 0;">{{ $chore->title }}</h3>
                        <p style="margin: 0;"><strong>Status:</strong> {{ $chore->status }}</p>
                        <p style="margin: 0;"><strong>Assigned to:</strong> {{ $chore->assignedUser->name ?? 'N/A' }}</p>
                    </div>
                @endforeach
            @else
                <p>No recent chores found.</p>
            @endif
        </div>
    </div>
</x-app-layout>