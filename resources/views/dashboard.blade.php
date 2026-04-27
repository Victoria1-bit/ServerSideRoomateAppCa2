@extends('layouts.app')

@section('content')
<div class="page-container">

    <div class="dashboard-heading">
        <h1>Dashboard</h1>
        <p>Welcome back, {{ auth()->user()->name }}</p>
    </div>

    <div class="feature-carousel">
        <div class="carousel-card">
            <small>Household</small>
            <h3>{{ auth()->user()->household->name ?? 'No household yet' }}</h3>
            <p>
                House code:
                <strong>{{ auth()->user()->household->code ?? 'Create or join one' }}</strong>
            </p>
        </div>

        <div class="carousel-card">
            <small>Chores</small>
            <h3>{{ $totalChores ?? 0 }} total chores</h3>
            <p>
                {{ $completedChores ?? 0 }} completed,
                {{ $pendingChores ?? 0 }} pending.
            </p>
        </div>

        <div class="carousel-card">
            <small>Expenses</small>
            <h3>€{{ number_format($totalSpent ?? 0, 2) }}</h3>
            <p>
                {{ $paidExpenses ?? 0 }} paid,
                {{ $pendingExpenses ?? 0 }} pending.
            </p>
        </div>
    </div>

    <div class="bolt-stat-grid">
        <div class="bolt-stat-card">
            <div class="stat-icon green">✓</div>
            <div>
                <p>Total Chores</p>
                <h2>{{ $totalChores ?? 0 }}</h2>
            </div>
        </div>

        <div class="bolt-stat-card">
            <div class="stat-icon green">●</div>
            <div>
                <p>Completed</p>
                <h2>{{ $completedChores ?? 0 }}</h2>
            </div>
        </div>

        <div class="bolt-stat-card">
            <div class="stat-icon yellow">€</div>
            <div>
                <p>Total Spent</p>
                <h2>€{{ number_format($totalSpent ?? 0, 2) }}</h2>
            </div>
        </div>

        <div class="bolt-stat-card">
            <div class="stat-icon blue">↗</div>
            <div>
                <p>Total Expenses</p>
                <h2>{{ $totalExpenses ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="bolt-status-grid">
        <div class="bolt-status-card">
            <h3>Chore Status</h3>

            <p>
                <span class="green-text">{{ $completedChores ?? 0 }} completed</span>
                <span class="orange-text">{{ $pendingChores ?? 0 }} pending</span>
            </p>

            <div class="progress-bar">
                <div style="width: {{ ($totalChores ?? 0) > 0 ? (($completedChores ?? 0) / ($totalChores ?? 1)) * 100 : 0 }}%"></div>
            </div>
        </div>

        <div class="bolt-status-card">
            <h3>Payment Status</h3>

            <p>
                <span class="green-text">{{ $paidExpenses ?? 0 }} paid</span>
                <span class="orange-text">{{ $pendingExpenses ?? 0 }} pending</span>
            </p>

            <div class="progress-bar">
                <div style="width: {{ ($totalExpenses ?? 0) > 0 ? (($paidExpenses ?? 0) / ($totalExpenses ?? 1)) * 100 : 0 }}%"></div>
            </div>
        </div>
    </div>

    <div class="card recent-card">
        <div class="list-header">
            <h2>Recent Chores</h2>
            <a href="{{ route('chores.index') }}" class="list-link">View all →</a>
        </div>

        @forelse($recentChores ?? [] as $chore)
            <div class="recent-row">
                <span class="dot"></span>

                <div>
                    <strong>{{ $chore->title }}</strong>
                    <p>{{ $chore->assignedUser->name ?? 'Unassigned' }}</p>
                </div>

                <span class="badge {{ $chore->status === 'completed' ? 'badge-success' : 'badge-warning' }}">
                    {{ ucfirst($chore->status) }}
                </span>
            </div>
        @empty
            <p>No chores yet.</p>
        @endforelse
    </div>

</div>
@endsection