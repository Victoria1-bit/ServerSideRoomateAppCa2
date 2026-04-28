<x-app-layout>
    <div style="padding: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 15px;">Edit Chore</h1>

        @if($errors->any())
            <div style="margin-bottom: 15px; padding: 10px 14px; background: #f8d7da; color: #721c24; border-radius: 6px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('chores.update', $chore) }}" method="POST" enctype="multipart/form-data" style="max-width: 520px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Title</label>
                <input type="text" name="title" value="{{ old('title', $chore->title) }}" required maxlength="255"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Description</label>
                <textarea name="description" rows="4" maxlength="2000"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; resize: vertical;">{{ old('description', $chore->description) }}</textarea>
            </div>

            @if($chore->image_path)
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Current Picture</label>
                    <img src="{{ asset('storage/' . $chore->image_path) }}" alt="Chore image"
                        style="width: 100%; max-height: 260px; object-fit: cover; border-radius: 10px; border: 1px solid #ddd;">
                </div>
            @endif

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Replace Picture</label>
                <input type="file" name="image" accept="image/png,image/jpeg,image/jpg,image/webp"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; background: white;">
                <small style="color:#64748b;">Optional. Upload JPG, PNG, or WEBP. Max 4MB.</small>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Assign To</label>
                <select name="assigned_to" required
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px;">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to', $chore->assigned_to) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 10px; align-items: center;">
                <button type="submit"
                    style="padding: 10px 18px; background: #f59e0b; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                    Update Chore
                </button>

                <a href="{{ route('chores.index') }}" style="color: #6b7280; text-decoration: none;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
