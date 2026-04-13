<x-app-layout>
    <div class="page-wrap">
        <h1 class="page-title">Dashboard</h1>

        <h2 class="section-title">Chore Overview</h2>
        <div class="stat-grid">
            <div class="card stat-card">
                <p class="stat-label">Total Chores</p>
                <p class="stat-value">{{ $totalChores }}</p>
            </div>

            <div class="card stat-card">
                <p class="stat-label">Completed</p>
                <p class="stat-value success">{{ $completedChores }}</p>
            </div>

            <div class="card stat-card">
                <p class="stat-label">Pending</p>
                <p class="stat-value warning">{{ $pendingChores }}</p>
            </div>
        </div>

        <h2 class="section-title">Expense Overview</h2>
        <div class="stat-grid">
            <div class="card stat-card">
                <p class="stat-label">Total Expenses</p>
                <p class="stat-value">{{ $totalExpenses }}</p>
            </div>

            <div class="card stat-card">
                <p class="stat-label">Total Spent</p>
                <p class="stat-value money">€{{ number_format($totalAmountSpent, 2) }}</p>
            </div>

            <div class="card stat-card">
                <p class="stat-label">Average Expense</p>
                <p class="stat-value info">€{{ number_format($averageExpenseAmount, 2) }}</p>
            </div>
        </div>

        <div class="content-grid">
            <div class="card list-panel">
                <div class="list-header">
                    <h2 class="list-title">Recent Chores</h2>
                    <a href="{{ route('chores.index') }}" class="list-link">View all ?</a>
                </div>

                @forelse($recentChores as $chore)
                    <div class="list-row">
                        <span>{{ $chore->title }}</span>
                        <span class="badge {{ $chore->status === 'completed' ? 'badge-success' : 'badge-warning' }}">
                            {{ ucfirst($chore->status) }}
                        </span>
                    </div>
                @empty
                    <p style="margin:0; color:#5f7a69;">No chores yet.</p>
                @endforelse
            </div>

            <div class="card list-panel">
                <div class="list-header">
                    <h2 class="list-title">Recent Expenses</h2>
                    <a href="{{ route('expenses.index') }}" class="list-link">View all ?</a>
                </div>

                @forelse($recentExpenses as $expense)
                    <div class="list-row">
                        <div>
                            <div style="font-weight:700;">{{ $expense->title }}</div>
                            <div class="expense-meta">
                                {{ $expense->creator->name ?? 'Unknown' }} • {{ $expense->created_at->format('d M Y') }}
                            </div>
                        </div>
                        <span class="badge badge-info">€{{ number_format($expense->amount, 2) }}</span>
                    </div>
                @empty
                    <p style="margin:0; color:#5f7a69;">No expenses yet.</p>
                @endforelse
            </div>
        </div>

        <div class="content-grid" style="margin-top:20px;">
            <div class="card list-panel">
                <div class="list-header">
                    <h2 class="list-title">Expense Highlights</h2>
                </div>

                <div class="list-row">
                    <div>
                        <div style="font-weight:700;">Largest Expense</div>
                        <div class="expense-meta">
                            {{ $largestExpense?->title ?? 'No expense yet' }}
                            @if($largestExpense)
                                • {{ $largestExpense->creator->name ?? 'Unknown' }}
                            @endif
                        </div>
                    </div>
                    <div style="font-weight:800; color:#1f7a4d;">
                        {{ $largestExpense ? '€' . number_format($largestExpense->amount, 2) : '—' }}
                    </div>
                </div>

                <div class="list-row">
                    <div>
                        <div style="font-weight:700;">Latest Expense</div>
                        <div class="expense-meta">
                            {{ $latestExpense?->title ?? 'No expense yet' }}
                            @if($latestExpense)
                                • {{ $latestExpense->created_at->format('d M Y') }}
                            @endif
                        </div>
                    </div>
                    <div style="font-weight:800; color:#1f7a4d;">
                        {{ $latestExpense ? '€' . number_format($latestExpense->amount, 2) : '—' }}
                    </div>
                </div>
            </div>

            <div class="dashboard-tip">
                <strong>Expenses workflow suggestion:</strong>
                add expense categories next, like Rent, Groceries, Utilities, Transport, and Shared Items.
                After that, the best upgrade is a “split between roommates” field so the app can show who owes what automatically.
            </div>
        </div>
    </div>
</x-app-layout>
