<x-app-layout>
    <div style="padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 style="font-size: 28px; font-weight: bold; margin: 0;">Expenses</h1>
            <a href="{{ route('expenses.create') }}"
               style="padding: 10px 16px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
                + Add Expense
            </a>
        </div>
 
        @if(session('success'))
            <div style="margin-bottom: 15px; padding: 10px 14px; background: #d4edda; color: #155724; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif
 
        <div style="margin-bottom: 20px; padding: 16px 20px; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; display: inline-block;">
            <span style="font-size: 14px; color: #1e40af;">Total Spent</span>
            <p style="margin: 4px 0 0; font-size: 28px; font-weight: 700; color: #1d4ed8;">
                &euro;{{ number_format($total, 2) }}
            </p>
        </div>
 
        @forelse($expenses as $expense)
            <div style="margin-bottom: 14px; padding: 16px; border: 1px solid #e5e7eb; border-radius: 8px; background: white; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 12px;">
                <div style="flex: 1; min-width: 200px;">
                    <h3 style="margin: 0 0 4px; font-size: 18px; font-weight: 600;">{{ $expense->title }}</h3>
                    <p style="margin: 0 0 4px; font-size: 13px; color: #6b7280;">
                        Added by <strong>{{ $expense->creator->name ?? 'Unknown' }}</strong>
                        &bull; {{ $expense->created_at->format('d M Y') }}
                    </p>
                    @if($expense->description)
                        <p style="margin: 6px 0 0; font-size: 14px; color: #374151;">{{ $expense->description }}</p>
                    @endif
                    <div style="display: flex; gap: 8px; margin-top: 12px; flex-wrap: wrap;">
                        @if(auth()->user()->role === 'admin' || $expense->created_by === auth()->id())
                            <a href="{{ route('expenses.edit', $expense) }}"
                               style="padding: 6px 12px; background: #f59e0b; color: white; text-decoration: none; border-radius: 5px; font-size: 13px;">
                                Edit
                            </a>
                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST"
                                  onsubmit="return confirm('Delete this expense?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="padding: 6px 12px; background: #dc2626; color: white; border: none; border-radius: 5px; font-size: 13px; cursor: pointer;">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <span style="font-size: 22px; font-weight: 700; color: #1d4ed8; white-space: nowrap;">
                    &euro;{{ number_format($expense->amount, 2) }}
                </span>
            </div>
        @empty
            <div style="padding: 40px; text-align: center; background: white; border: 1px solid #e5e7eb; border-radius: 8px; color: #6b7280;">
                <p style="margin: 0; font-size: 16px;">No expenses yet.</p>
                <a href="{{ route('expenses.create') }}" style="display: inline-block; margin-top: 12px; color: #2563eb;">
                    Add your first expense &rarr;
                </a>
            </div>
        @endforelse
    </div>
</x-app-layout>
