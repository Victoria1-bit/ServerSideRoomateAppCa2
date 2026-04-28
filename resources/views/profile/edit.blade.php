<x-app-layout>
    <div class="profile-page">
        <h1>My Profile</h1>

        @if(session('success'))
            <div class="profile-alert">{{ session('success') }}</div>
        @endif

        <div class="profile-card">
            <div class="profile-photo-wrap">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="profile-photo" alt="Profile photo">
                @else
                    <div class="profile-placeholder">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
                @csrf
                @method('PATCH')

                <div>
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" value="{{ auth()->user()->email }}" disabled>
                </div>

                <div>
                    <label>Role</label>
                    <input type="text" value="{{ auth()->user()->role === 'admin' ? 'HouseKeeper' : ucfirst(auth()->user()->role) }}" disabled>
                </div>

                <div>
                    <label>Profile Picture</label>
                    <input type="file" name="profile_photo" accept="image/png,image/jpeg,image/jpg,image/webp">
                </div>

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </div>

    <style>
        .profile-page {
            max-width: 900px;
            margin: 0 auto;
            padding: 32px;
        }

        .profile-page h1 {
            font-size: 32px;
            font-weight: 800;
            color: #14382b;
            margin-bottom: 22px;
        }

        .profile-alert {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-weight: 700;
        }

        .profile-card {
            background: white;
            border: 1px solid #dbe7df;
            border-radius: 22px;
            padding: 28px;
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 28px;
            align-items: start;
        }

        .profile-photo,
        .profile-placeholder {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #dcfce7;
        }

        .profile-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #14382b;
            color: white;
            font-size: 70px;
            font-weight: 900;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .profile-form label {
            display: block;
            font-weight: 800;
            margin-bottom: 6px;
            color: #14382b;
        }

        .profile-form input {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 10px 12px;
        }

        .profile-form button {
            background: #14382b;
            color: white;
            border: none;
            padding: 11px 16px;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            width: fit-content;
        }

        @media (max-width: 700px) {
            .profile-card {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-app-layout>
