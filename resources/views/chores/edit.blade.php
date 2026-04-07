<x-app-layout>
    <div style="padding: 20px;">
        <h1>Edit Chore</h1>

        @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('chores.update', $chore) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 10px;">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $chore->title) }}" required>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Assign To</label>
                <select name="assigned_to" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to', $chore->assigned_to) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Status</label>
                <select name="status" required>
                    <option value="pending" {{ old('status', $chore->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status', $chore->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit">Update Chore</button>
        </form>

        <div style="margin-top: 15px;">
            <a href="{{ route('chores.index') }}">Back</a>
        </div>
    </div>
</x-app-layout>