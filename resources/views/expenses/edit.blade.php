<x-app-layout>
    <div class="page-wrap">
        <h1 class="page-title">Edit Expense</h1>

        @if($errors->any())
            <div class="flash-error">
                <ul style="margin:0; padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('expenses.update', $expense) }}" method="POST" class="card form-shell">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div>
                    <label class="form-label" for="title">Expense Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $expense->title) }}" class="form-input" required>
                </div>

                <div>
                    <label class="form-label" for="category">Category</label>
                    <select name="category" id="category" class="form-select" required>
                        @php
                            $categories = ['Rent', 'Groceries', 'Utilities', 'Transport', 'Shared Items'];
                        @endphp

                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ old('category', $expense->category) === $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label" for="amount">Amount (€)</label>
                    <input type="number" name="amount" id="amount" step="0.01" min="0.01" value="{{ old('amount', $expense->amount) }}" class="form-input" required>
                </div>

                <div>
                    <label class="form-label" for="payment_status">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="form-select" required>
                        <option value="pending" {{ old('payment_status', $expense->payment_status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('payment_status', $expense->payment_status) === 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>

                <div>
                    <label class="form-label" for="description">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-textarea">{{ old('description', $expense->description) }}</textarea>
                </div>

                <div>
                    <label class="form-label" for="split_type">Split Type</label>
                    <select name="split_type" id="split_type" class="form-select" onchange="toggleSelectedUsers()" required>
                        <option value="all" {{ old('split_type', $expense->split_type) === 'all' ? 'selected' : '' }}>Split with everyone</option>
                        <option value="selected" {{ old('split_type', $expense->split_type) === 'selected' ? 'selected' : '' }}>Split with selected roommates</option>
                    </select>
                </div>

                <div id="selectedUsersWrapper" style="display: {{ old('split_type', $expense->split_type) === 'selected' ? 'block' : 'none' }};">
                    <label class="form-label">Select Roommates</label>

                    @php
                        $selectedUsers = old('selected_users', $expense->selected_users ?? []);
                    @endphp

                    <div class="card-soft" style="padding:16px;">
                        @foreach($users as $user)
                            <label style="display:block; margin-bottom:8px;">
                                <input
                                    type="checkbox"
                                    name="selected_users[]"
                                    value="{{ $user->id }}"
                                    {{ in_array($user->id, $selectedUsers ?? []) ? 'checked' : '' }}
                                >
                                {{ $user->name }}
                            </label>
                        @endforeach
                    </div>

                    @error('selected_users')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-warning">Update Expense</button>
                <a href="{{ route('expenses.index') }}" class="btn btn-ghost">Back to Expenses</a>
            </div>
        </form>
    </div>

    <script>
        function toggleSelectedUsers() {
            const splitType = document.getElementById('split_type').value;
            const wrapper = document.getElementById('selectedUsersWrapper');

            wrapper.style.display = splitType === 'selected' ? 'block' : 'none';
        }
    </script>
</x-app-layout>

