<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 15px;">Create Chore</h1>
 
        @if($errors->any())
            <div style="margin-bottom: 15px; padding: 10px 14px; background: #f8d7da; color: #721c24; border-radius: 6px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
        <form action="{{ route('chores.store') }}" method="POST" id="createChoreForm" novalidate
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
 
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Assign To</label>
                <select
                    name="assigned_to"
                    id="assigned_to"
                    required
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; box-sizing: border-box;"
                >
                    <option value="">Select user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <span id="assignError" style="display: none; color: #dc2626; font-size: 13px; margin-top: 4px;">
                    Please select a user to assign this chore to.
                </span>
            </div>
 
            <div style="display: flex; gap: 10px; align-items: center;">
                <button
                    type="submit"
                    style="padding: 10px 18px; background: #2563eb; color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer;"
                >
                    Save Chore
                </button>
                <a href="{{ route('chores.index') }}" style="font-size: 14px; color: #6b7280; text-decoration: none;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
 
    <script>
        document.getElementById('createChoreForm').addEventListener('submit', function (e) {
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

