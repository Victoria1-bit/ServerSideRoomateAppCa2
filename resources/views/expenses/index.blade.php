<x-app-layout>
    <div class="page-wrap">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:20px;">
            <div>
                <h1 class="page-title" style="margin-bottom:6px;">Shared Expenses</h1>
                <p style="margin:0; color:#5f7a69;">Track what the house is spending together.</p>
            </div>

            <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                + Add Expense
            </a>
        </div>

        @if(session('success'))
            <div class="flash-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="expense-summary">
            <div class="card expense-card">
                <p class="stat-label">Total Entries</p>
                <p class="stat-value">{{ $expenses->count() }}</p>
            </div>

            <div class="card expense-card">
                <p class="stat-label">Total Spent</p>
                <p class="stat-value money">€{{ number_format($total, 2) }}</p>
            </div>

            <div class="card expense-card">
                <p class="stat-label">Latest Added</p>
                <p class="stat-value" style="font-size:1.2rem;">
                    {{ $expenses->first()?->title ?? 'No expenses yet' }}
                </p>
            </div>
        </div>

        <div class="expense-list">
            @forelse($expenses as $expense)
                <div class="card expense-item">
                    <div style="flex:1; min-width:260px;">
                        <h3 style="margin:0 0 6px; font-size:1.2rem; font-weight:800;">{{ $expense->title }}</h3>

                        <p class="expense-meta" style="margin:0 0 8px;">
                            Added by <strong>{{ $expense->creator->name ?? 'Unknown' }}</strong>
                            • {{ $expense->created_at->format('d M Y') }}
                        </p>

                        <p style="margin:0 0 8px; color:#294637;">
                            <strong>Category:</strong> {{ $expense->category }}
                        </p>

                        <p style="margin:0 0 8px; color:#294637;">
                            <strong>Payment Status:</strong>
                            <span class="badge {{ $expense->payment_status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                                {{ ucfirst($expense->payment_status) }}
                            </span>
                        </p>

                        <p style="margin:0 0 8px; color:#294637;">
                            <strong>Split:</strong> {{ $expense->split_label }}
                        </p>

                        @if($expense->split_type === 'selected' && count($expense->selected_user_names))
                            <p style="margin:0 0 10px; color:#294637;">
                                <strong>Shared With:</strong> {{ implode(', ', $expense->selected_user_names) }}
                            </p>
                        @endif

                        <p style="margin:0; color:#294637;">
                            {{ $expense->description ?: 'No description added yet.' }}
                        </p>

                        @if(auth()->user()->role === 'admin' || $expense->created_by === auth()->id())
                            <div class="inline-actions">
                                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('Delete this expense?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="expense-amount">
                        €{{ number_format($expense->amount, 2) }}
                    </div>
                </div>
            @empty
                <div class="card empty-state">
                    <h3 style="margin:0 0 10px; font-size:1.2rem; color:#1c402d;">No expenses yet</h3>
                    <p style="margin:0 0 14px;">Start with rent, groceries, or utility bills.</p>
                    <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                        Add your first expense
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

