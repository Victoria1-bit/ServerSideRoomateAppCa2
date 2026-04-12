<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 20px;">Add Expense</h1>
 
        @if($errors->any())
            <div style="margin-bottom: 15px; padding: 10px 14px; background: #f8d7da; color: #721c24; border-radius: 6px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
        <form action="{{ route('expenses.store') }}" method="POST" id="createExpenseForm" novalidate
              style="max-width: 480px;">
            @csrf
 
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    maxlength="255"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;"
                >
                <span id="titleError" style="display: none; color: #dc2626; font-size: 13px; margin-top: 4px;">
                    Title is required.
                </span>
            </div>
 
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Amount (€)</label>
                <input
                    type="number"
                    name="amount"
                    id="amount"
                    value="{{ old('amount') }}"
                    required
                    step="0.01"
                    min="0.01"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;"
                >
                <span id="amountError" style="display: none; color: #dc2626; font-size: 13px; margin-top: 4px;">
                    Please enter a valid amount greater than 0.
                </span>
            </div>
 
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">
                    Description <span style="font-weight: normal; color: #9ca3af;">(optional)</span>
                </label>
                <textarea
                    name="description"
                    id="description"
                    rows="3"
                    maxlength="1000"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box; resize: vertical;"
                >{{ old('description') }}</textarea>
                <span id="descError" style="display: none; color: #dc2626; font-size: 13px; margin-top: 4px;">
                    Description cannot exceed 1000 characters.
                </span>
            </div>
 
            <div style="display: flex; gap: 10px; align-items: center;">
                <button
                    type="submit"
                    style="padding: 10px 18px; background: #2563eb; color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer;"
                >
                    Save Expense
                </button>
                <a href="{{ route('expenses.index') }}" style="font-size: 14px; color: #6b7280; text-decoration: none;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
 
    <script>
        document.getElementById('createExpenseForm').addEventListener('submit', function (e) {
            let valid = true;
 
            const title      = document.getElementById('title');
            const titleError = document.getElementById('titleError');
            if (!title.value.trim()) {
                titleError.style.display = 'block';
                title.style.borderColor  = '#dc2626';
                valid = false;
            } else {
                titleError.style.display = 'none';
                title.style.borderColor  = '#ccc';
            }
 
            const amount      = document.getElementById('amount');
            const amountError = document.getElementById('amountError');
            if (!amount.value || parseFloat(amount.value) <= 0) {
                amountError.style.display = 'block';
                amount.style.borderColor  = '#dc2626';
                valid = false;
            } else {
                amountError.style.display = 'none';
                amount.style.borderColor  = '#ccc';
            }
 
            const desc      = document.getElementById('description');
            const descError = document.getElementById('descError');
            if (desc.value.length > 1000) {
                descError.style.display = 'block';
                desc.style.borderColor  = '#dc2626';
                valid = false;
            } else {
                descError.style.display = 'none';
                desc.style.borderColor  = '#ccc';
            }
 
            if (!valid) e.preventDefault();
        });
    </script>
</x-app-layout>
