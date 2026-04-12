<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 30px; font-weight: bold; margin-bottom: 20px;">Dashboard</h1>
        <h2 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #374151;">Chores</h2>
        <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px;">
            <div style="flex:1; min-width:120px; padding:20px; border:1px solid #ccc; border-radius:8px; background:#fff;">
                <p style="margin:0 0 6px; font-size:13px; color:#6b7280;">Total Chores</p>
                <p style="margin:0; font-size:32px; font-weight:600;">{{ $totalChores }}</p>
            </div>
            <div style="flex:1; min-width:120px; padding:20px; border:1px solid #ccc; border-radius:8px; background:#fff;">
                <p style="margin:0 0 6px; font-size:13px; color:#6b7280;">Completed</p>
                <p style="margin:0; font-size:32px; font-weight:600; color:#16a34a;">{{ $completedChores }}</p>
            </div>
            <div style="flex:1; min-width:120px; padding:20px; border:1px solid #ccc; border-radius:8px; background:#fff;">
                <p style="margin:0 0 6px; font-size:13px; color:#6b7280;">Pending</p>
                <p style="margin:0; font-size:32px; font-weight:600; color:#d97706;">{{ $pendingChores }}</p>
            </div>
        </div>
        <h2 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #374151;">Expenses</h2>
        <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px;">
            <div style="flex:1; min-width:120px; padding:20px; border:1px solid #ccc; border-radius:8px; background:#fff;">
                <p style="margin:0 0 6px; font-size:13px; color:#6b7280;">Total Expenses</p>
                <p style="margin:0; font-size:32px; font-weight:600;">{{ $totalExpenses }}</p>
            </div>
            <div style="flex:1; min-width:120px; padding:20px; border:1px solid #ccc; border-radius:8px; background:#fff;">
                <p style="margin:0 0 6px; font-size:13px; color:#6b7280;">Total Spent</p>
                <p style="margin:0; font-size:32px; font-weight:600; color:#2563eb;">€{{ number_format($totalAmountSpent, 2) }}</p>
            </div>
        </div>
        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div style="flex:1; min-width:260px; padding:20px; border:1px solid #ccc; border-radius:8px; background:#fff;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                    <h2 style="margin:0; font-size:16px; font-weight:600;">Recent Chores</h2>
                    <a href="{{ route('chores.index') }}" style="font-size:13px; color:#2563eb; text-decoration:none;">View all →</a>
                </div>
                @forelse($recentChores as $chore)
                    <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #f3f4f6;">
                        <span style="font-size:14px;">{{ $chore->title }}</span>
                        <span style="font-size:12px; padding:2px 8px; border-radius:12px; background:{{ $chore->status === 'completed' ? '#dcfce7' : '#fef9c3' }}; color:{{ $chore->status === 'completed' ? '#15803d' : '#854d0e' }};">{{ $chore->status }}</span>
                    </div>
                @empty
                    <p style="font-size:14px; color:#6b7280;">No chores yet.</p>
                @endforelse
            </div>
            <div style="flex:1; min-width:260px; padding:20px; border:1px solid #ccc; border-radius:8px; background:#fff;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                    <h2 style="margin:0; font-size:16px; font-weight:600;">Recent Expenses</h2>
                    <a href="{{ route('expenses.index') }}" style="font-size:13px; color:#2563eb; text-decoration:none;">View all →</a>
                </div>
                @forelse($recentExpenses as $expense)
                    <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #f3f4f6;">
                        <div>
                            <span style="font-size:14px; display:block;">{{ $expense->title }}</span>
                            <span style="font-size:12px; color:#6b7280;">{{ $expense->creator->name ?? 'Unknown' }}</span>
                        </div>
                        <span style="font-size:14px; font-weight:600; color:#2563eb; white-space:nowrap;">€{{ number_format($expense->amount, 2) }}</span>
                    </div>
                @empty
                    <p style="font-size:14px; color:#6b7280;">No expenses yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
