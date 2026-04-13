<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 15px;">Edit Chore</h1>

        @if($errors->any())
            <div style="margin-bottom: 15px; padding: 10px; background: #f8d7da; color: #721c24; border-radius: 6px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('chores.update', $chore) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $chore->title) }}"
                    required
                    maxlength="255"
                    style="width: 100%; max-width: 400px; padding: 8px; border: 1px solid #ccc; border-radius: 6px;"
                >
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Assign To</label>
                <select
                    name="assigned_to"
                    required
                    style="width: 100%; max-width: 400px; padding: 8px; border: 1px solid #ccc; border-radius: 6px;"
                >
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $chore->assigned_to == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <span id="assignError" style="display: none; color: #dc2626; font-size: 13px; margin-top: 4px;">
                    Please select a user to assign this chore to.
                </span>
            </div>

            <button
                type="submit"
                style="padding: 10px 14px; background: #f59e0b; color: white; border: none; border-radius: 6px; cursor: pointer;"
            >
                Update Chore
            </button>
        </form>
    </div>
 
    <script>
        document.getElementById('editChoreForm').addEventListener('submit', function (e) {
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
 
            const assigned    = document.getElementById('assigned_to');
            const assignError = document.getElementById('assignError');
            if (!assigned.value) {
                assignError.style.display  = 'block';
                assigned.style.borderColor = '#dc2626';
                valid = false;
            } else {
                assignError.style.display  = 'none';
                assigned.style.borderColor = '#ccc';
            }
 
            if (!valid) e.preventDefault();
        });
    </script>
</x-app-layout>

