<x-app-layout>
    <div style="padding: 20px;">

        <h1 style="font-size: 30px; font-weight: bold; margin-bottom: 20px;">
            Dashboard
        </h1>

        <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px;">

            <div style="flex:1; padding:20px; border:1px solid #ccc; border-radius:8px;">
                <h2>Total Chores</h2>
                <p style="font-size: 28px;">{{ $totalChores }}</p>
            </div>

            <div style="flex:1; padding:20px; border:1px solid #ccc; border-radius:8px;">
                <h2>Completed</h2>
                <p style="font-size: 28px; color: green;">{{ $completedChores }}</p>
            </div>

            <div style="flex:1; padding:20px; border:1px solid #ccc; border-radius:8px;">
                <h2>Pending</h2>
                <p style="font-size: 28px; color: orange;">{{ $pendingChores }}</p>
            </div>

        </div>

        <div style="padding: 20px; border:1px solid #ccc; border-radius:8px;">
            <h2>Recent Chores</h2>

            @if($recentChores->count())
                @foreach($recentChores as $chore)
                    <div style="margin-bottom: 10px;">
                        <strong>{{ $chore->title }}</strong> - {{ $chore->status }}
                    </div>
                @endforeach
            @else
                <p>No chores yet.</p>
            @endif
        </div>

    </div>
</x-app-layout>