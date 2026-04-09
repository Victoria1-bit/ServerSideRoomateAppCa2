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

        <a href="{{ route('chores.index') }}"
           style="display: inline-block; padding: 10px 14px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px;">
            View Chores
        </a>
    </div>
</x-app-layout>
