<x-app-layout>
    <div class="join-page">
        <div class="join-card">
            <div class="join-icon">🔑</div>
            <h1>Join a house</h1>
            <p>Enter the invite code your HouseKeeper gave you.</p>

            @if($errors->any())
                <div class="join-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('house.join.submit') }}" method="POST">
                @csrf

                <input type="text" name="invite_code" placeholder="Example: CHHOUSE2026" value="{{ old('invite_code') }}" required>
                <button type="submit">Join House</button>
            </form>

            <div class="join-demo">
                <strong>Demo note:</strong> For school/local testing, the HouseKeeper shares the invite code manually.
            </div>
        </div>
    </div>

    <style>
        .join-page {
            min-height: calc(100vh - 90px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }

        .join-card {
            width: 100%;
            max-width: 560px;
            text-align: center;
            background: white;
            border: 1px solid #dbe7df;
            border-radius: 26px;
            padding: 34px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }

        .join-icon {
            font-size: 54px;
            margin-bottom: 10px;
        }

        .join-card h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 900;
            color: #14382b;
        }

        .join-card p {
            color: #64748b;
            margin-bottom: 22px;
        }

        .join-card form {
            display: flex;
            gap: 10px;
        }

        .join-card input {
            flex: 1;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 12px 14px;
            text-transform: uppercase;
        }

        .join-card button {
            background: #14382b;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 900;
            cursor: pointer;
        }

        .join-demo {
            margin-top: 22px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
            color: #64748b;
            font-size: 14px;
        }

        .join-error {
            background: #fee2e2;
            color: #991b1b;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 16px;
            text-align: left;
        }

        .join-error p {
            margin: 0;
            color: #991b1b;
        }

        @media (max-width: 650px) {
            .join-card form {
                flex-direction: column;
            }
        }
    </style>
</x-app-layout>
