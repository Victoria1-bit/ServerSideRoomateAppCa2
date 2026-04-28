<x-app-layout>
    <div class="expenses-page">

        <div class="expenses-header">
            <div>
                <h1>Expenses</h1>
                <p>Track shared costs, payments, and splits.</p>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('expenses.create') }}" class="expenses-create-btn">+ Add Expense</a>
            @endif
        </div>

        <div class="expenses-grid">
            @forelse($expenses as $expense)
                <div class="expense-card">

                    <div class="expense-top">
                        <div>
                            <h3>{{ $expense->title }}</h3>
                            <p class="expense-meta">
                                Added by <strong>{{ $expense->creator->name ?? 'Unknown' }}</strong>
                                • {{ $expense->created_at->format('d M Y') }}
                            </p>
                        </div>

                        <div class="expense-amount">
                            €{{ number_format($expense->amount, 2) }}
                        </div>
                    </div>

                    <div class="expense-body">
                        <div class="expense-left">
                            <div><span>Category</span><strong>{{ $expense->category }}</strong></div>
                            <div>
                                <span>Status</span>
                                <strong class="badge {{ $expense->payment_status === 'paid' ? 'paid' : 'pending' }}">
                                    {{ ucfirst($expense->payment_status) }}
                                </strong>
                            </div>
                        </div>

                        <div class="expense-right">
                            <div><span>Split</span><strong>{{ $expense->split_type }}</strong></div>
                            <div><span>Shared With</span><strong>{{ $expense->shared_with }}</strong></div>
                        </div>
                    </div>

                    @if($expense->description)
                        <p class="expense-description">{{ $expense->description }}</p>
                    @endif

                    <div class="expense-actions">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('expenses.edit', $expense) }}" class="btn edit">Edit</a>
                        @endif

                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn delete">Delete</button>
                            </form>
                        @endif
                    </div>

                </div>
            @empty
                <p>No expenses found.</p>
            @endforelse
        </div>

    </div>

    <style>
        .expenses-page {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }

        .expenses-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .expenses-header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 800;
        }

        .expenses-header p {
            margin: 4px 0 0;
            color: #64748b;
        }

        .expenses-create-btn {
            background: #14382b;
            color: white;
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .expenses-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .expense-card {
            background: white;
            border-radius: 20px;
            padding: 22px;
            border: 1px solid #dbe7df;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .expense-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .expense-top h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
        }

        .expense-meta {
            font-size: 13px;
            color: #64748b;
        }

        .expense-amount {
            font-size: 22px;
            font-weight: 800;
            color: #166534;
        }

        .expense-body {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 14px;
        }

        .expense-body div span {
            display: block;
            font-size: 12px;
            color: #64748b;
        }

        .expense-body strong {
            font-size: 14px;
        }

        .expense-left,
        .expense-right {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 999px;
        }

        .badge.paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge.pending {
            background: #ffedd5;
            color: #9a3412;
        }

        .expense-description {
            color: #475569;
            margin: 10px 0;
        }

        .expense-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 10px;
            font-weight: 700;
            color: white;
            border: none;
        }

        .btn.edit {
            background: #f59e0b;
        }

        .btn.delete {
            background: #dc2626;
        }

        @media (max-width: 900px) {
            .expenses-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-app-layout>

