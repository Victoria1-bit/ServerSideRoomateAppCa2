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

        <form action="{{ route('chores.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 520px;">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required maxlength="255"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Description</label>
                <textarea name="description" rows="4" maxlength="2000"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; resize: vertical;">{{ old('description') }}</textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Picture of Area</label>
                <input type="file" name="image" accept="image/png,image/jpeg,image/jpg,image/webp"
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; background: white;">
                <small style="color:#64748b;">Optional. Upload JPG, PNG, or WEBP. Max 4MB.</small>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Assign To</label>
                <select name="assigned_to" required
                    style="width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px;">
                    <option value="">Select user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 10px; align-items: center;">
                <button type="submit"
                    style="padding: 10px 18px; background: #2563eb; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                    Save Chore
                </button>

                <a href="{{ route('chores.index') }}" style="color: #6b7280; text-decoration: none;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
