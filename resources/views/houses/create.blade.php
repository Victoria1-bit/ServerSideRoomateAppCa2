<x-app-layout>
    <div class="house-create-page">
        <div class="house-create-card">
            <div>
                <span class="house-pill">HouseKeeper Setup</span>
                <h1>Create your house</h1>
                <p>Create one house for your roommates. The app will generate an invite code for members to join.</p>
            </div>

            @if($errors->any())
                <div class="house-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('house.store') }}" method="POST">
                @csrf

                <label>House Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Green Villa" required>

                <button type="submit">Create House</button>
            </form>
        </div>
    </div>

    <style>
        .house-create-page {
            min-height: calc(100vh - 90px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }

        .house-create-card {
            width: 100%;
            max-width: 620px;
            background: white;
            border: 1px solid #dbe7df;
            border-radius: 26px;
            padding: 32px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }

        .house-pill {
            display: inline-flex;
            background: #dcfce7;
            color: #166534;
            padding: 7px 12px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .house-create-card h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 900;
            color: #14382b;
        }

        .house-create-card p {
            color: #64748b;
            line-height: 1.6;
        }

        .house-create-card form {
            margin-top: 22px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .house-create-card label {
            font-weight: 800;
            color: #14382b;
        }

        .house-create-card input {
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .house-create-card button {
            margin-top: 8px;
            background: #14382b;
            color: white;
            border: none;
            border-radius: 14px;
            padding: 12px 16px;
            font-weight: 900;
            cursor: pointer;
        }

        .house-error {
            background: #fee2e2;
            color: #991b1b;
            border-radius: 12px;
            padding: 12px 16px;
            margin-top: 16px;
        }

        .house-error p {
            margin: 0;
            color: #991b1b;
        }
    </style>
</x-app-layout>
