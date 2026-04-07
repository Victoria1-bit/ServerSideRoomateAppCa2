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
                <input type="text" name="title" value="{{ old('title', $chore->title) }}" required
                    style="width: 100%; max-width: 400px; padding: 8px; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Assign To</label>
                <select name="assigned_to" required
                    style="width: 100%; max-width: 400px; padding: 8px; border: 1px solid #ccc; border-radius: 6px;">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to', $chore->assigned_to) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                style="padding: 10px 14px; background: #f59e0b; color: white; border: none; border-radius: 6px; cursor: pointer;">
                Update Chore
            </button>
        </form>

        <div style="margin-top: 15px;">
            <a href="{{ route('chores.index') }}" style="color: #2563eb; text-decoration: none;">← Back to Chores</a>
        </div>
    </div>
</x-app-layout>