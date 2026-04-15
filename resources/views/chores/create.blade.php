{{-- Wraps the page in the main app layout (includes navbar, sidebar, etc.) --}}
<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 15px;">Create Chore</h1>

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

        {{-- Form submits to the chores.store route via POST --}}
        <form action="{{ route('chores.store') }}" method="POST">

            {{-- CSRF token to protect against cross-site request forgery attacks --}}
            @csrf

            {{-- Title input — old('title') repopulates the field if validation fails --}}
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    maxlength="255"
                    style="width: 100%; max-width: 400px; padding: 8px; border: 1px solid #ccc; border-radius: 6px;"
                >
            </div>

            {{-- Dropdown to select which user the chore should be assigned to
                 $users is passed in from ChoreController@create --}}
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Assign To</label>
                <select
                    name="assigned_to"
                    required
                    style="width: 100%; max-width: 400px; padding: 8px; border: 1px solid #ccc; border-radius: 6px;"
                >
                    <option value="">Select user</option>
                    {{-- Loop through all users and render each as a dropdown option --}}
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

                {{-- Inline error message for the assign field — hidden by default, shown via JS if invalid --}}
                <span id="assignError" style="display: none; color: #dc2626; font-size: 13px; margin-top: 4px;">
                    Please select a user to assign this chore to.
                </span>
            </div>

            {{-- Submit button to save the new chore --}}
            <button
                type="submit"
                style="padding: 10px 14px; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer;"
            >
                Save Chore
            </button>
        </form>
    </div>

    <script>
        // Client-side validation — runs when the form is submitted
        // Prevents the form from being sent if required fields are empty
        document.getElementById('createChoreForm').addEventListener('submit', function (e) {
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