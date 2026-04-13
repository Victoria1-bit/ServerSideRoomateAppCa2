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
                <p class="stat-label">Paid Expenses</p>
                <p class="stat-value success">{{ $paidExpensesCount }}</p>
            </div>

            <div class="card stat-card">
                <p class="stat-label">Pending Expenses</p>
                <p class="stat-value warning">{{ $pendingExpensesCount }}</p>
            </div>

            <div class="card stat-card">
                <p class="stat-label">Paid Amount</p>
                <p class="stat-value success">€{{ number_format($paidExpensesTotal, 2) }}</p>
            </div>

            <div class="card stat-card">
                <p class="stat-label">Pending Amount</p>
                <p class="stat-value warning">€{{ number_format($pendingExpensesTotal, 2) }}</p>
            </div>
        </div>

        <div class="content-grid">
            <div class="card list-panel">
                <div class="list-header">
                    <h2 class="list-title">Recent Chores</h2>
                    <a href="{{ route('chores.index') }}" class="list-link">View all →</a>
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
                    <a href="{{ route('expenses.index') }}" class="list-link">View all →</a>
                </div>

                @forelse($recentExpenses as $expense)
                    <div class="list-row">
                        <div>
                            <div style="font-weight:700;">{{ $expense->title }}</div>
                            <div class="expense-meta">
                                {{ $expense->creator->name ?? 'Unknown' }} • {{ $expense->created_at->format('d M Y') }}
                            </div>
                        </div>
                        <div style="text-align:right;">
                            <div class="badge badge-info">€{{ number_format($expense->amount, 2) }}</div>
                            <div style="margin-top:6px;">
                                <span class="badge {{ $expense->payment_status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                                    {{ ucfirst($expense->payment_status) }}
                                </span>
                            </div>
                        </div>
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
        </div>

        <h2 class="section-title" style="margin-top:28px;">History Summary</h2>
        <div class="content-grid">
            <div class="card list-panel">
                <div class="list-header">
                    <h2 class="list-title">Chores History</h2>
                </div>

                <div class="list-row">
                    <span>This Week</span>
                    <strong>{{ $weeklyChores }}</strong>
                </div>

                <div class="list-row">
                    <span>This Month</span>
                    <strong>{{ $monthlyChores }}</strong>
                </div>

                <div class="list-row">
                    <span>This Year</span>
                    <strong>{{ $yearlyChores }}</strong>
                </div>
            </div>

            <div class="card list-panel">
                <div class="list-header">
                    <h2 class="list-title">Expenses History</h2>
                </div>

                <div class="list-row">
                    <span>This Week</span>
                    <div style="text-align:right;">
                        <div><strong>{{ $weeklyExpensesCount }}</strong> expenses</div>
                        <div class="expense-meta">€{{ number_format($weeklyExpensesTotal, 2) }}</div>
                    </div>
                </div>

                <div class="list-row">
                    <span>This Month</span>
                    <div style="text-align:right;">
                        <div><strong>{{ $monthlyExpensesCount }}</strong> expenses</div>
                        <div class="expense-meta">€{{ number_format($monthlyExpensesTotal, 2) }}</div>
                    </div>
                </div>

                <div class="list-row">
                    <span>This Year</span>
                    <div style="text-align:right;">
                        <div><strong>{{ $yearlyExpensesCount }}</strong> expenses</div>
                        <div class="expense-meta">€{{ number_format($yearlyExpensesTotal, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
