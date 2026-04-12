<x-app-layout>
    <div style="padding:20px; max-width:600px; margin:auto;">
        <h1>Edit Chore</h1>

        <form method="POST" action="{{ route('chores.update', $chore) }}">
            @csrf
            @method('PUT')

            <div>
                <label>Title</label>
                <input type="text" name="title" value="{{ $chore->title }}" required class="w-full border p-2">
            </div>

            <div>
                <label>Assign To</label>
                <select name="assigned_to" class="w-full border p-2">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $chore->assigned_to == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Due Date</label>
                <input type="date" name="due_date" value="{{ $chore->due_date }}" class="w-full border p-2">
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>