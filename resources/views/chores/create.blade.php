<x-app-layout>
    <h1>Create Chore</h1>

    <form action="{{ route('chores.store') }}" method="POST">
        @csrf

        <div>
            <label>Title</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Assign To</label>
            <select name="assigned_to" required>
                <option value="">Select user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Create</button>
    </form>

    <a href="{{ route('chores.index') }}">Back</a>
</x-app-layout>