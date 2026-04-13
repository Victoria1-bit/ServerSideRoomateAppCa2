<x-app-layout>
    <div class="page-wrap">
        <h1 class="page-title">Add Expense</h1>

        @if($errors->any())
            <div class="flash-error">
                <ul style="margin:0; padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('expenses.store') }}" method="POST" id="createExpenseForm" novalidate class="card form-shell">
            @csrf

            <div class="form-grid">
                <div>
                    <label class="form-label" for="title">Expense Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required maxlength="255" class="form-input">
                    <div class="form-help">Examples: Groceries, WiFi Bill, Cleaning Supplies</div>
                    <span id="titleError" class="error-text" style="display:none;">Title is required.</span>
                </div>

                <div>
                    <label class="form-label" for="amount">Amount (€)</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required step="0.01" min="0.01" class="form-input">
                    <div class="form-help">Use the full amount paid.</div>
                    <span id="amountError" class="error-text" style="display:none;">Please enter a valid amount greater than 0.</span>
                </div>

                <div>
                    <label class="form-label" for="description">Description</label>
                    <textarea name="description" id="description" rows="4" maxlength="1000" class="form-textarea">{{ old('description') }}</textarea>
                    <div class="form-help">Optional note, like what was bought or why it was needed.</div>
                    <span id="descError" class="error-text" style="display:none;">Description cannot exceed 1000 characters.</span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Expense</button>
                <a href="{{ route('expenses.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('createExpenseForm').addEventListener('submit', function (e) {
            let valid = true;

            const title = document.getElementById('title');
            const titleError = document.getElementById('titleError');
            if (!title.value.trim()) {
                titleError.style.display = 'block';
                title.style.borderColor = '#dc2626';
                valid = false;
            } else {
                titleError.style.display = 'none';
                title.style.borderColor = '#cde5d5';
            }

            const amount = document.getElementById('amount');
            const amountError = document.getElementById('amountError');
            if (!amount.value || parseFloat(amount.value) <= 0) {
                amountError.style.display = 'block';
                amount.style.borderColor = '#dc2626';
                valid = false;
            } else {
                amountError.style.display = 'none';
                amount.style.borderColor = '#cde5d5';
            }

            const desc = document.getElementById('description');
            const descError = document.getElementById('descError');
            if (desc.value.length > 1000) {
                descError.style.display = 'block';
                desc.style.borderColor = '#dc2626';
                valid = false;
            } else {
                descError.style.display = 'none';
                desc.style.borderColor = '#cde5d5';
            }

            if (!valid) e.preventDefault();
        });
    </script>
</x-app-layout>
