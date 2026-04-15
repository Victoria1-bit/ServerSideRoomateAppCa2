{{-- Wraps the page in the main app layout (includes navbar, sidebar, etc.) --}}
<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 15px;">Edit Chore</h1>

        {{-- Validation error summary — shown if the form was submitted with invalid data
             Loops through all errors and lists them in a red box --}}
        @if($errors->any())
            <div style="margin-bottom: 15px; padding: 10px; background: #f8d7da; color: #721c24; border-radius: 6px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form submits to the chores.update route via POST
             @method('PUT') spoofs a PUT request since HTML forms only support GET and POST --}}
        <form action="{{ route('chores.update', $chore) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Title input — old('title', $chore->title) tries the previously submitted value first,
                 then falls back to the chore's current title so the field is always pre-filled --}}
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

            {{-- Dropdown to reassign the chore to a different user
                 The currently assigned user is pre-selected using a ternary check --}}
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Assign To</label>
                <select
                    name="assigned_to"
                    required
                    style="width: 100%; max-width: 400px; padding: 8px; border: 1px solid #ccc; border-radius: 6px;"
                >
                    {{-- Loop through all users — mark the currently assigned one as selected --}}
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $chore->assigned_to == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Inline error message for the assign field — hidden by default, shown via JS if invalid --}}
                <span id="assignError" style="display: none; color: #dc2626; font-size: 13px; margin-top: 4px;">
                    Please select a user to assign this chore to.
                </span>
            </div>

            {{-- Submit button to save the updated chore — amber colour to distinguish from the create form --}}
            <button
                type="submit"
                style="padding: 10px 14px; background: #f59e0b; color: white; border: none; border-radius: 6px; cursor: pointer;"
            >
                Update Chore
            </button>
        </form>
    </div>

    <script>
        // Client-side validation — runs when the edit form is submitted
        // Prevents the form from being sent if required fields are empty
        document.getElementById('editChoreForm').addEventListener('submit', function (e) {
            let valid = true;

            // Check the title field is not blank
            const title      = document.getElementById('title');
            const titleError = document.getElementById('titleError');
            if (!title.value.trim()) {
                // Show the error message and highlight the field in red
                titleError.style.display = 'block';
                title.style.borderColor  = '#dc2626';
                valid = false;
            } else {
                // Hide the error and reset the border if the field is valid
                titleError.style.display = 'none';
                title.style.borderColor  = '#ccc';
            }

            // Check that a user has been selected from the dropdown
            const assigned    = document.getElementById('assigned_to');
            const assignError = document.getElementById('assignError');
            if (!assigned.value) {
                // Show the error message and highlight the dropdown in red
                assignError.style.display  = 'block';
                assigned.style.borderColor = '#dc2626';
                valid = false;
            } else {
                // Hide the error and reset the border if a user is selected
                assignError.style.display  = 'none';
                assigned.style.borderColor = '#ccc';
            }

            // If any field is invalid, stop the form from submitting
            if (!valid) e.preventDefault();
        });
    </script>
</x-app-layout>