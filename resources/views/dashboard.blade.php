<x-app-layout>
    <x-slot name="header">
        <div class="dash-header">
            <h2>Dashboard</h2>
            <p>Overview of chores, expenses, and roommate activity</p>
        </div>
    </x-slot>

    <style>
        .dash-wrap {
            max-width: 1300px;
            margin: 0 auto;
            padding: 32px;
        }

        .dash-header h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
            color: #14382b;
        }

        .dash-header p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .overview-title {
            margin: 0 0 14px;
            font-size: 22px;
            font-weight: 800;
            color: #14382b;
        }

        .expenses-title {
            margin-top: 8px;
        }

        .expenses-overview {
            grid-template-columns: repeat(3, 1fr);
            margin-bottom: 34px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #dbe7df;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        }

        .stat-card span {
            display: block;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .stat-card strong {
            color: #14382b;
            font-size: 28px;
            font-weight: 800;
        }

        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 34px;
        }

        .panel,
        .chart-card {
            background: #ffffff;
            border: 1px solid #dbe7df;
            border-radius: 20px;
            padding: 26px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        }

        .panel h3,
        .chart-card h3 {
            margin: 0 0 18px;
            color: #14382b;
            font-size: 18px;
            font-weight: 800;
        }

        .list-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            padding: 14px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .list-row:last-child {
            border-bottom: none;
        }

        .list-row strong {
            color: #14382b;
        }

        .list-row small {
            display: block;
            margin-top: 4px;
            color: #64748b;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge.done {
            background: #dcfce7;
            color: #166534;
        }

        .badge.pending {
            background: #ffedd5;
            color: #9a3412;
        }

        .analytics-title {
            margin: 0;
            font-size: 26px;
            color: #14382b;
            font-weight: 800;
        }

        .analytics-subtitle {
            margin: 6px 0 22px;
            color: #64748b;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .chart-card canvas {
            max-height: 280px;
        }

        @media (max-width: 900px) {
            .stats-grid,
            .main-grid,
            .charts-grid {
                grid-template-columns: 1fr;
            }

            .dash-wrap {
                padding: 18px;
            }
        }
            .overview-title {
            margin: 0 0 14px;
            font-size: 22px;
            font-weight: 800;
            color: #14382b;
        }

        .expenses-title {
            margin-top: 8px;
        }

        .chores-overview {
            grid-template-columns: repeat(3, 1fr);
        }

        .expenses-overview {
            grid-template-columns: repeat(3, 1fr);
            margin-bottom: 34px;
        }

        @media (max-width: 900px) {
            .chores-overview,
            .expenses-overview {
                grid-template-columns: 1fr;
            }
        }
            .panel-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .panel-title-row h3 {
            margin: 0;
        }

        .panel-link-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: #14382b;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .panel-link-btn:hover {
            background: #0f2f24;
            transform: translateY(-1px);
        }
    </style>

    <div class="dash-wrap">
        <h2 class="overview-title">Chores Overview</h2>

<div class="stats-grid chores-overview">
    <div class="stat-card">
        <span>Total Chores</span>
        <strong>{{ $totalChores }}</strong>
    </div>

    <div class="stat-card">
        <span>Completed Chores</span>
        <strong>{{ $completedChores }}</strong>
    </div>

    <div class="stat-card">
        <span>Pending Chores</span>
        <strong>{{ $pendingChores }}</strong>
    </div>
</div>

<h2 class="overview-title expenses-title">Expenses Overview</h2>

<div class="stats-grid expenses-overview">
    <div class="stat-card">
        <span>Total Expenses</span>
        <strong>{{ $totalExpenses }}</strong>
    </div>

    <div class="stat-card">
        <span>Total Amount of Expenses</span>
        <strong>€{{ number_format($totalAmountSpent, 2) }}</strong>
    </div>

    <div class="stat-card">
        <span>Paid Expenses</span>
        <strong>{{ $paidExpensesCount }}</strong>
    </div>

    <div class="stat-card">
        <span>Total Paid Amount</span>
        <strong>€{{ number_format($paidExpensesTotal, 2) }}</strong>
    </div>

    <div class="stat-card">
        <span>Pending Expenses</span>
        <strong>{{ $pendingExpensesCount }}</strong>
    </div>

    <div class="stat-card">
        <span>Total Pending Amount</span>
        <strong>€{{ number_format($pendingExpensesTotal, 2) }}</strong>
    </div>
</div>
<div class="main-grid">
            <div class="panel">
                <div class="panel-title-row"><h3>Recent Chores</h3><a href="{{ route('chores.index') }}" class="panel-link-btn">View Chores</a></div>

                @forelse($recentChores as $chore)
                    <div class="list-row">
                        <div>
                            <strong>{{ $chore->title }}</strong>
                            <small>{{ $chore->assignedUser->name ?? 'Unassigned' }}</small>
                        </div>

                        <span class="badge {{ $chore->status === 'completed' ? 'done' : 'pending' }}">
                            {{ ucfirst($chore->status) }}
                        </span>
                    </div>
                @empty
                    <p>No chores yet.</p>
                @endforelse
            </div>

            <div class="panel">
                <div class="panel-title-row"><h3>Recent Expenses</h3><a href="{{ route('expenses.index') }}" class="panel-link-btn">View Expenses</a></div>

                @forelse($recentExpenses as $expense)
                    <div class="list-row">
                        <div>
                            <strong>{{ $expense->title }}</strong>
                            <small>{{ $expense->creator->name ?? 'Unknown' }}</small>
                        </div>

                        <div style="display:flex; flex-direction:column; align-items:flex-end; gap:8px;"><strong>€{{ number_format($expense->amount, 2) }}</strong><span class="badge {{ $expense->payment_status === 'paid' ? 'done' : 'pending' }}">{{ ucfirst($expense->payment_status) }}</span></div>
                    </div>
                @empty
                    <p>No expenses yet.</p>
                @endforelse
            </div>
        </div>

        <h2 class="analytics-title">Analytics</h2>
        <p class="analytics-subtitle">Visual breakdown of chores and expenses</p>

        <div class="charts-grid">
            <div class="chart-card">
                <h3>Completed Chores By Member</h3>
                <canvas id="choresPerUserChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Chore Status</h3>
                <canvas id="choreStatusChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Expenses By Member</h3>
                <canvas id="expensesPerUserChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Expenses By Category</h3>
                <canvas id="expenseCategoryChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Chore Frequency Last 30 Days</h3>
                <canvas id="choresOverTimeChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Expense Spending Last 30 Days</h3>
                <canvas id="expensesOverTimeChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        new Chart(document.getElementById('choresPerUserChart'), {
            type: 'bar',
            data: {
                labels: @json($choresPerUser->pluck('name')),
                datasets: [{
                    label: 'Completed Chores',
                    data: @json($choresPerUser->pluck('total')),
                    backgroundColor: '#16a34a'
                }]
            }
        });

        new Chart(document.getElementById('choreStatusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending'],
                datasets: [{
                    data: [{{ $completedChores }}, {{ $pendingChores }}],
                    backgroundColor: ['#16a34a', '#f59e0b']
                }]
            }
        });

        new Chart(document.getElementById('expensesPerUserChart'), {
            type: 'bar',
            data: {
                labels: @json($expensesPerUser->pluck('name')),
                datasets: [{
                    label: 'Total Spent (€)',
                    data: @json($expensesPerUser->pluck('total')),
                    backgroundColor: '#2563eb'
                }]
            }
        });

        new Chart(document.getElementById('expenseCategoryChart'), {
            type: 'pie',
            data: {
                labels: @json($expenseCategories->pluck('category')),
                datasets: [{
                    data: @json($expenseCategories->pluck('total')),
                    backgroundColor: ['#16a34a', '#2563eb', '#f59e0b', '#dc2626', '#7c3aed']
                }]
            }
        });

        new Chart(document.getElementById('choresOverTimeChart'), {
            type: 'bar',
            data: {
                labels: @json($choresOverTime->pluck('date')),
                datasets: [{
                    label: 'Chores Created',
                    data: @json($choresOverTime->pluck('total')),
                    backgroundColor: '#0f766e'
                }]
            }
        });

        new Chart(document.getElementById('expensesOverTimeChart'), {
            type: 'bar',
            data: {
                labels: @json($expensesOverTime->pluck('date')),
                datasets: [{
                    label: 'Money Spent (€)',
                    data: @json($expensesOverTime->pluck('total')),
                    backgroundColor: '#ea580c'
                }]
            }
        });
    </script>
</x-app-layout>



